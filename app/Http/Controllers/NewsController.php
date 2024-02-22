<?php

namespace App\Http\Controllers;

use App\Models\NewsTicker;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\News;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    //admin view news
    public function news_all()
    {
        $data['data'] = News::with('brand')->orderBy('id', 'DESC')->get();

        return view('admin.news.view-all-news', $data);
    }

    public function add_news()
    {
        $data['brands'] = Brand::whereRaw("flags & ? = ?", [Brand::FLAG_ACTIVE, Brand::FLAG_ACTIVE])->orderBy('brand_name', 'ASC')->get();
        return view('admin.news.add', $data);
    }

    public function add_news_process(Request $request)
    {
        $news = new News();
        $news->title = $request->title;
        $news->description = !empty($request->description) ? $request->description : '';
        $news->news_slug = $sulugname = Str::slug($request->title);
        $news->brand_id = $request->brand;
        $news->section = $request->section;
        $news->created_name = $request->created_name;

        if ($request->status == 1) {
            $news->addFlag(News::FLAG_ACTIVE);
        } else {
            //$news->addFlag(News::FLAG_ACTIVE);
            $news->flags = 0;
        }
        $news->save();
        $sulgname_update = $sulugname.'-'.$news->id;
        News::where('id',$news->id)->update(['news_slug' => $sulgname_update]); 

        if (!is_dir(storage_path("app/public/news/"))) {
            mkdir(storage_path("app/public/news/"), 0777, true);

        }

        mkdir(storage_path("app/public/news/" . $news->id), 0777, true);

        if (\File::exists($request->image)) {
            $file_name = addFileOrignal($request->image, storage_path("app/public/news/" . $news->id));
            $news->news_image = $file_name;
            $artisan_call_to_make_files_public = \Artisan::call("storage:link", []);
            if ($artisan_call_to_make_files_public) {
                DB::rollBack();
            }
        }

        if ($news->save())
            return redirect()->route('news_all')->with(['message' => "News Added Successfully"]);
        else
            return redirect()->route('news_all')->with(['error' => "News does not added, kindly try again"]);
    }


    public function edit_news(News $id)
    {
        $data['news'] = $id;
        $data['brands'] = Brand::whereRaw("flags & ? = ?", [Brand::FLAG_ACTIVE, Brand::FLAG_ACTIVE])->orderBy('brand_name', 'ASC')->get();
        return view('admin.news.edit-news', $data);
    }

    public function edit_news_process(Request $request)
    {
        $news = News::where('id', $request->id)->first();
        $news->title = $request->input('title', $news->title);
        $news->description = $request->input('description', $news->description);
        $news->news_slug = Str::slug($request->title).'-'.$request->id;
        $news->brand_id = $request->input('brand', $news->brand);
        $news->created_name = $request->input('created_name', $news->created_name);
      	$news->section = $request->section;
        $news->removeFlag(News::FLAG_ACTIVE);
        if ($request->status == 1) {
            $news->addFlag(News::FLAG_ACTIVE);
        } else {
            $news->flags = 0;
           // $news->addFlag(News::FLAG_ACTIVE);
        }

        if (\File::exists($request->image)) {

            $file_name = addFileOrignal($request->image, storage_path("app/public/news/" . $news->id));
            if ($file_name) {
                if ($news->news_image) {
                    unlink(storage_path("app/public/news/" . $news->id . '/' . $news->news_image));
                }

                $news->news_image = $file_name;
            }
        }

        if ($news->save())
            return redirect()->route('news_all')->with(['message' => "News Added Successfully"]);
        else
            return redirect()->route('news_all')->with(['error' => "News does not added, kindly try again"]);
    }

    public function news_delete(News $id)
    {
        if ($id->delete())
            return redirect()->route('news_all')->with(['message' => "News Delete Successfully"]);
        else
            return redirect()->route('news_all')->with(['error' => "News does not added, kindly try again"]);
    }

    public function news_ticker_home()
    {
        $data['newsticker'] = NewsTicker::first();
        return view('admin.newsticker.index', $data);
    }

    public function save_news_ticker(Request $request)
    {
        $news_ticker = NewsTicker::first() ?: new NewsTicker();
        $news_ticker->title = $request->title;
        $news_ticker->content = $request->message;
        $news_ticker->text_color = $request->text_color;
        $news_ticker->bg_color = $request->bg_color;
        $news_ticker->flags = $request->active ? 1 : 0;

        if ($news_ticker->save()) {
            return back()->with(['message' => "News Ticker Added Successfully"]);
        }

        return back()->with(['error' => "News Ticker does not added, kindly try again"]);
    }
}
