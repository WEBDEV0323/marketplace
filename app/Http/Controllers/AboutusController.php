<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aboutus;
use DB;
use Str;

class AboutusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['data'] = Aboutus::whereIn('about_type_key',['banner_images','influencer_images','testimonial_images','industry_data','statistics'])->whereNotNull('image')->orderBy('id','DESC')->get();
        return view('admin.aboutus.banner.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.aboutus.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->image_type == 'banner_images'){
            if($request->banner_image_video == 'video_radio'){
                $request->validate([
                    'image_video'  => 'required',
                ]);
            }else{
                $request->validate([
                    'image'  => 'required',
                ]);
            }           
        }else{
            $request->validate([
                'image'  => 'required',
            ]);
        }
                
        $banner_about = new Aboutus();
        $banner_about->flags = 1;
        $banner_about->about_type_key = $request->image_type;
        $banner_about->save();   
        if($request->image_type == 'banner_images'){  
            if(\File::exists($request->image)){
                if (!is_dir(public_path("/storage/about_us/banner"))) {
                    mkdir(public_path("/storage/about_us/banner"), 0777, true);
                }
                $file_name = addFileOrignal($request->image, public_path("/storage/about_us/banner"));
                Aboutus::where('id', $banner_about->id)->update(['image' => $file_name]);        
            }
            if(\File::exists($request->image_video)){
                if (!is_dir(public_path("/storage/about_us/banner"))) {
                    mkdir(public_path("/storage/about_us/banner"), 0777, true);
                }
                $file_video = $request->file('image_video'); 
                $filename = Str::random(16).time() .uniqid() . '.' . $file_video->getClientOriginalExtension();
                $request->image_video->move(public_path('/storage/about_us/banner'),  $filename);
                Aboutus::where('id', $banner_about->id)->update(['image' => $filename,'titile'=>'Video']);        
            }
        }
        if($request->image_type == 'influencer_images'){  
            if(\File::exists($request->image)){
                if (!is_dir(public_path("/storage/about_us/influencer"))) {
                    mkdir(public_path("/storage/about_us/influencer"), 0777, true);
                }
                $file_name = addFileOrignal($request->image, public_path("/storage/about_us/influencer"));
                Aboutus::where('id', $banner_about->id)->update(['image' => $file_name]);        
            }
        }
        if($request->image_type == 'testimonial_images'){  
            if(\File::exists($request->image)){
                if (!is_dir(public_path("/storage/about_us/testimonial"))) {
                    mkdir(public_path("/storage/about_us/testimonial"), 0777, true);
                }
                $file_name = addFileOrignal($request->image, public_path("/storage/about_us/testimonial"));
                Aboutus::where('id', $banner_about->id)->update(['image' => $file_name]);        
            }
        }
        if($request->image_type == 'industry_data'){  
            if(\File::exists($request->image)){
                if (!is_dir(public_path("/storage/about_us/industry_data"))) {
                    mkdir(public_path("/storage/about_us/industry_data"), 0777, true);
                }
                $file_name = addFileOrignal($request->image, public_path("/storage/about_us/industry_data"));
                Aboutus::where('id', $banner_about->id)->update(['image' => $file_name]);        
            }
        }
        if($request->image_type == 'statistics'){  
            if(\File::exists($request->image)){
                if (!is_dir(public_path("/storage/about_us/statistics"))) {
                    mkdir(public_path("/storage/about_us/statistics"), 0777, true);
                }
                $file_name = addFileOrignal($request->image, public_path("/storage/about_us/statistics"));
                Aboutus::where('id', $banner_about->id)->update(['image' => $file_name]);        
            }
        }
        if($banner_about->save()){
            return redirect(route('aboutus.banner'))->with(["message" => "Image Added Successfully"]);
        }else{
            return redirect(route('aboutus.banner'))->with(["error" => "Something Wrong, Please Try Again"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Aboutus::whereIn('about_type_key',['banner_images','influencer_images','testimonial_images','industry_data','statistics'])->where('id',$id)->first();
        if($data){
            return view('admin.aboutus.banner.edit',['data' => $data]);
        }else{
            return redirect(route('aboutus.banner'))->with(["error" => "Something Wrong, Please Try Again"]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         Aboutus::where('id', $id)->update(['flags'=> $request->status]);    
        // if(\File::exists($request->image)){
        //     if (!is_dir(public_path("/storage/about_us/banner"))) {
        //         mkdir(public_path("/storage/about_us/banner"), 0777, true);
        //     }
        //     $file_name = addFileOrignal($request->image, public_path("/storage/about_us/banner"));
        //     Aboutus::where('id', $id)->update(['image' => $file_name]);        
        // }
        
        if($request->image_type == 'banner_images'){  
            if(\File::exists($request->image)){
                if (!is_dir(public_path("/storage/about_us/banner"))) {
                    mkdir(public_path("/storage/about_us/banner"), 0777, true);
                }
                $file_name = addFileOrignal($request->image, public_path("/storage/about_us/banner"));
                Aboutus::where('id', $id)->update(['image' => $file_name]);        
            }

            if(\File::exists($request->image_video)){
                if (!is_dir(public_path("/storage/about_us/banner"))) {
                    mkdir(public_path("/storage/about_us/banner"), 0777, true);
                }
                $file_video = $request->file('image_video'); 
                $filename = Str::random(16).time() .uniqid() . '.' . $file_video->getClientOriginalExtension();
                $request->image_video->move(public_path('/storage/about_us/banner'),  $filename);
                Aboutus::where('id', $id)->update(['image' => $filename,'titile'=>'Video']);        
            }

        }
        if($request->image_type == 'influencer_images'){  
            if(\File::exists($request->image)){
                if (!is_dir(public_path("/storage/about_us/influencer"))) {
                    mkdir(public_path("/storage/about_us/influencer"), 0777, true);
                }
                $file_name = addFileOrignal($request->image, public_path("/storage/about_us/influencer"));
                Aboutus::where('id', $id)->update(['image' => $file_name]);        
            }
        }
        if($request->image_type == 'testimonial_images'){  
            if(\File::exists($request->image)){
                if (!is_dir(public_path("/storage/about_us/testimonial"))) {
                    mkdir(public_path("/storage/about_us/testimonial"), 0777, true);
                }
                $file_name = addFileOrignal($request->image, public_path("/storage/about_us/testimonial"));
                Aboutus::where('id', $id)->update(['image' => $file_name]);        
            }
        }
        if($request->image_type == 'industry_data'){  
            if(\File::exists($request->image)){
                if (!is_dir(public_path("/storage/about_us/industry_data"))) {
                    mkdir(public_path("/storage/about_us/industry_data"), 0777, true);
                }
                $file_name = addFileOrignal($request->image, public_path("/storage/about_us/industry_data"));
                Aboutus::where('id', $id)->update(['image' => $file_name]);        
            }
        }
        if($request->image_type == 'statistics'){  
            if(\File::exists($request->image)){
                if (!is_dir(public_path("/storage/about_us/statistics"))) {
                    mkdir(public_path("/storage/about_us/statistics"), 0777, true);
                }
                $file_name = addFileOrignal($request->image, public_path("/storage/about_us/statistics"));
                Aboutus::where('id', $id)->update(['image' => $file_name]);        
            }
        }

       return redirect(route('aboutus.banner'))->with(["message" => "Banner Update Successfully"]);
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Aboutus::find($id)->delete();
    
        if($banner){
        return redirect(route('aboutus.banner'))->with(["message" => "Banner Deleted Successfully"]);
        }
        else{
        return redirect(route('aboutus.banner'))->with(["error" => "Something Wrong, Please Try Again"]);
        }
    }

    public function contentShow(){
        $data['our_story'] = Aboutus::where('about_type_key','our_story')->first();
        $data['our_mission'] = Aboutus::where('about_type_key','our_mission')->first();
        $data['our_vision'] = Aboutus::where('about_type_key','our_vision')->first();
        return view('admin.aboutus.about_content',$data);
    }
    public function contentStore(Request $request){
      $our_story = Aboutus::where('about_type_key','our_story')->first();
      $our_mission  = Aboutus::where('about_type_key','our_mission')->first();
      $our_vision  = Aboutus::where('about_type_key','our_vision')->first();
        if($our_story){
            Aboutus::where('about_type_key','our_story')->update(['description' => $request->our_story]); 
        }else{
            $about_our_story = new Aboutus();
            $about_our_story->flags = 1;
            $about_our_story->about_type_key = "our_story";
            $about_our_story->description = $request->our_story;
            $about_our_story->save();      
        }

        if($our_mission){
            Aboutus::where('about_type_key','our_mission')->update(['description' => $request->our_mission]);
        }else{
            $about_our_mission = new Aboutus();
            $about_our_mission->flags = 1;
            $about_our_mission->about_type_key = "our_mission";
            $about_our_mission->description = $request->our_mission;
            $about_our_mission->save();   
        }

        if($our_vision){
            Aboutus::where('about_type_key','our_vision')->update(['description' => $request->our_vision]); 
        }else{
            $about_our_vision = new Aboutus();
            $about_our_vision->flags = 1;
            $about_our_vision->about_type_key = "our_vision";
            $about_our_vision->description = $request->our_vision;
            $about_our_vision->save();   
        }
        return redirect(route('aboutus.content'))->with(["message" => "Successfully Update"]);
    }


    // meet our team
    public function ourTeamIndex()
    {
        $data['data'] = Aboutus::where('about_type_key','our_team')->orderBy('id','DESC')->get();
        return view('admin.aboutus.our_team.index',$data);
    }

   public function ourTeamCreate()
    {
        return view('admin.aboutus.our_team.create');
    }

 public function ourTeamStore(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'position'  => 'required',
            'description'  => 'required',
            'image'  => 'required',
        ]);
        $our_team = new Aboutus();
        $our_team->flags = 1;
        $our_team->about_type_key = "our_team";
        $our_team->titile = $request->name;
        $our_team->sub_titile = $request->position;
        $our_team->description = $request->description;
        $our_team->save();      
      if(\File::exists($request->image)){
        if (!is_dir(public_path("/storage/about_us/our_team"))) {
            mkdir(public_path("/storage/about_us/our_team"), 0777, true);
        }
        $file_name = addFileOrignal($request->image, public_path("/storage/about_us/our_team"));
        Aboutus::where('id', $our_team->id)->update(['image' => $file_name]);        
    }
        if($our_team->save()){
            return redirect(route('aboutus.ourteam'))->with(["message" => "Team Member Added Successfully"]);
        }else{
            return redirect(route('aboutus.ourteam'))->with(["error" => "Something Wrong, Please Try Again"]);
        }
    }

    public function ourTeamCreatedit($id)
    {
        $data = Aboutus::where('about_type_key','our_team')->where('id',$id)->first();
        if($data){
            return view('admin.aboutus.our_team.edit',['data' => $data]);
        }else{
            return redirect(route('aboutus.ourteam'))->with(["error" => "Something Wrong, Please Try Again"]);
        }
    }

        public function ourTeamupdate(Request $request, $id)
        {
            $request->validate([
                'name'  => 'required',
                'position'  => 'required',
                'description'  => 'required',
            ]);  
            Aboutus::where('id', $id)->update(['titile' => $request->name, 'sub_titile'=>$request->position, 'description'=> $request->description, 'flags'=> $request->status]); 
            if(\File::exists($request->image)){
                if (!is_dir(public_path("/storage/about_us/our_team"))) {
                    mkdir(public_path("/storage/about_us/our_team"), 0777, true);
                }
                $file_name = addFileOrignal($request->image, public_path("/storage/about_us/our_team"));
                Aboutus::where('id', $id)->update(['image' => $file_name]);        
            }
            return redirect(route('aboutus.ourteam'))->with(["message" => "Update Successfully"]);
            
        }

        public function ourTeamdestroy($id)
        {
            $banner = Aboutus::find($id)->delete();
        
            if($banner){
            return redirect(route('aboutus.ourteam'))->with(["message" => "Deleted Successfully"]);
            }
            else{
            return redirect(route('aboutus.ourteam'))->with(["error" => "Something Wrong, Please Try Again"]);
            }
        }
    // meet our team


   // key Metrics
    public function keyMetricsIndex()
    {
        $data['data'] = Aboutus::where('about_type_key','key_metrics')->orderBy('id','asc')->get();
        return view('admin.aboutus.keymetrics.index',$data);
    }
  
     public function keyMetricsCreate()
      {
          return view('admin.aboutus.keymetrics.create');
      }
  
   public function keyMetricsStore(Request $request)
      {
          $request->validate([
              'title'  => 'required',
              'value'  => 'required',
          ]);
          $our_team = new Aboutus();
          $our_team->flags = 1;
          $our_team->about_type_key = "key_metrics";
          $our_team->titile = $request->title;
          $our_team->sub_titile = $request->value;
          $our_team->description = $request->plus_sign;
          $our_team->save();   
          if($our_team->save()){
              return redirect(route('aboutus.keymetrics'))->with(["message" => "Key Metrics Added Successfully"]);
          }else{
              return redirect(route('aboutus.keymetrics'))->with(["error" => "Something Wrong, Please Try Again"]);
          }
      }
  
      public function keyMetricsCreatedit($id)
      {
          $data = Aboutus::where('about_type_key','key_metrics')->where('id',$id)->first();
          if($data){
              return view('admin.aboutus.keymetrics.edit',['data' => $data]);
          }else{
              return redirect(route('aboutus.keymetrics'))->with(["error" => "Something Wrong, Please Try Again"]);
          }
      }
  
    public function keyMetricsupdate(Request $request, $id)
    {
        $request->validate([
            'title'  => 'required',
            'value'  => 'required',
        ]); 
        Aboutus::where('id', $id)->update(['titile' => $request->title, 'sub_titile'=>$request->value, 'description'=> $request->plus_sign]); 
        
        return redirect(route('aboutus.keymetrics'))->with(["message" => "Update Successfully"]);
        
    }
  
    public function keyMetricsdestroy($id)
    {
        $banner = Aboutus::find($id)->delete();
    
        if($banner){
        return redirect(route('aboutus.keymetrics'))->with(["message" => "Deleted Successfully"]);
        }
        else{
        return redirect(route('aboutus.keymetrics'))->with(["error" => "Something Wrong, Please Try Again"]);
        }
    }
      // key Metrics

      //settings
      public function settingShow(){
        $data['contact_us_url'] = Aboutus::where('about_type_key','contact_us_url')->first();
        $data['instagram_url'] = Aboutus::where('about_type_key','instagram_url')->first();
        return view('admin.aboutus.about_setting',$data);
    }
    public function settingStore(Request $request){
      $contact_us_url =  Aboutus::where('about_type_key','contact_us_url')->first();
      $instagram_url  = Aboutus::where('about_type_key','instagram_url')->first();
        if($contact_us_url){
            Aboutus::where('about_type_key','contact_us_url')->update(['description' => $request->contact_us_url]); 
        }else{
            $about_contact_us_url = new Aboutus();
            $about_contact_us_url->flags = 1;
            $about_contact_us_url->about_type_key = "contact_us_url";
            $about_contact_us_url->description = $request->contact_us_url;
            $about_contact_us_url->save();      
        }

        if($instagram_url){
            Aboutus::where('about_type_key','instagram_url')->update(['description' => $request->instagram_url]);
        }else{
            $about_instagram_url = new Aboutus();
            $about_instagram_url->flags = 1;
            $about_instagram_url->about_type_key = "instagram_url";
            $about_instagram_url->description = $request->instagram_url;
            $about_instagram_url->save();   
        }
        return redirect(route('aboutus.setting'))->with(["message" => "Successfully Update"]);
    }
      //settings

}
