<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Order;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('documents')) {

            try {
                $files = $request->file('documents');
                $order_id = $request->order_id;
                $user_id = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : 0;

                foreach ($files as $file) {

                    $filename = $file->getClientOriginalName();
                    $name = ucwords(pathinfo($filename, PATHINFO_FILENAME));
                    $ext = $file->getClientOriginalExtension();

                    //file store
                    $file->storeAs("documents/shipping/$order_id", $filename, 'public');

                    //save data in db
                    $document = Document::where('order_id', $order_id)->where('filename', $filename)->first() ?: new Document();
                    $document->order_id = $order_id;
                    $document->user_id = $user_id;
                    $document->name = $name;
                    $document->filename = $filename;
                    $document->extension = $ext;
                    $document->flags = 1;

                    $document->save();
                }

                return "true";

            } catch (\Exception $e) {

                return $e->getMessage();
            }
        }

        return "Unable to save documents!";
    }

    public function download($id)
    {
        $doc = Document::find(decrypt($id));

        if($doc){
            if(file_exists($path = $this->getDocumentPath($doc->order_id, $doc->filename))){

                return response()->download($path);
            }
        }

        abort(404);
    }

    public function delete($id)
    {
        $doc = Document::find($id);

        if ($doc) {
            if (file_exists($path = $this->getDocumentPath($doc->order_id, $doc->filename))) {
                @unlink($path);
            }

            $doc->delete();

            return redirect()->back()->with(["message" => "Document delete successfully!"]);
        }

        abort(404);
    }

    public function send_mail(Request $request)
    {
        $docs = Document::where('order_id', $request->order_id)->where('email_status', 'pending')->get();
        $order = Order::find($request->order_id);
        $user = $order->user ?? null;
        //if exist send email to seller paypal email, otherwise send to user login email
        $to = (Card::where('user_id', $order->user_id)->first()->selling_paypal_email ?? '') ?: ($user->email ?? '');
        $to_name = ($user->first_name ?? '') . ' ' . ($user->last_name ?? '');
        $from = config('mail.from.address');
        $from_name = config('mail.from.name');
        $subject = "Shipping Documents";

        if (empty($to)) {

            return "Failed: There is no email address found!";
        }

        if ($docs && count($docs) > 0) {

            $data = [
                'order_id' => $order->id ?? '',
                'date' => $order->created_at ?? '2000-01-01 00:00:00',
                'reference' => $order->reference ?? '',
                'name' => $to_name,
            ];

            try {
                //send email
                Mail::send('emails.shipping_doc', $data, function ($message) use ($to, $to_name, $from, $from_name, $subject, $docs) {
                    $message->to($to, $to_name)
                        ->from($from, $from_name)
                        ->subject($subject);

                    foreach ($docs as $doc) {
                        //attach documents
                        $message->attach($this->getDocumentPath($doc->order_id, $doc->filename));
                    }
                });

                //update document email status sent or not
                Document::where('order_id', $request->order_id)->where('email_status', 'pending')->update(['email_status' => 'sent']);

                return "true";

            } catch (\Exception $e) {

                return $e->getMessage();
            }
        }

        return "Failed: There are no documents to attach, or already sent to the seller!";
    }

    private function getDocumentPath($order_id, $filename = null)
    {
        if ($filename) {

            return storage_path("app/public/documents/shipping/$order_id/$filename");
        }

        return storage_path("app/public/documents/shipping/$order_id");
    }

}
