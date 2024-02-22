<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Artisan;
use App\Imports\ImpProducts;
use Illuminate\Http\Request;
use App\Models\Product;
use DB;

class ImportProductController extends Controller
{
    public function index()
    {
        $data['data'] = [];
        return view('admin.import.importHome', $data);
    }

    public function process(Request $request)
    {

        try {
            
            if ($request->hasFile('import_file_name')) {
    
                $file = $request->file('import_file_name');
                $extension = $file->getClientOriginalExtension();
                $path = $file->getRealPath();
    
                 if (!in_array($extension, ['csv', 'xls', 'xlsx'])) {

                    return Redirect::back()->with(["error" => "The only acceptable formats are CSV, XLS, XLSX"]);
                }
    
                Excel::import(new ImpProducts(), $file);
                //$data = Excel::toArray('', $path, null, \Maatwebsite\Excel\Excel::CSV)[0]; // getting data from csv
    
                $artisan_call_to_make_files_public = Artisan::call("storage:link", []);
                if ($artisan_call_to_make_files_public) {
                
                    //error return
                }
                    
                return Redirect::back()->with(["message" => "Data has been imported!"]);
            }
    
            return Redirect::back()->with(["error" => "Something Wrong, Please Try Again"]);
            
        } catch (\Exception $e) {
    
            return Redirect::back()->with(["error" => $e->getMessage()]);
        }
    }
    
}
