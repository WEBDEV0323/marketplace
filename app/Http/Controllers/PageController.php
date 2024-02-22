<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use Str;

class PageController extends Controller
{
    public function privacy_policy(){
        $page = Page::where('key','privacy_policy')->first(); 
        return view('admin.page.privacy-policy',['data' => $page]);
    }

    public function policy_process(Request $request){
        
        $page = new Page(); 
        $page->title = $request->title;
        $page->slug =  Str::slug($request->title);
        $page->key =  'privacy_policy';
        $page->description = htmlspecialchars($request->description);
        //$page->addFlag(Page::FLAG_ACTIVE);
        if($page->save()){
            return back()->with(['message' => "Content Added Successfully"]);
          }else{
            return back()->with(['error' => "User Is not Valid Please Try Again"]);
        }
    }
}
