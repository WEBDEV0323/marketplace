<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Video;

class VideoController extends Controller
{
  
    public function __construct()
    {
       // $this->middleware('auth'); // Ensure the user is authenticated for all methods
        
    }
  
  
    
  
  
  
    public function index()
    {
        $videos = Video::all();

        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        $existingVideo = Video::first();

        // If a video exists, redirect back with a message
        if ($existingVideo) {
            return redirect()->route('videos.index')->with('error', 'Only one video can be added.');
        }

        return view('admin.videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'video' => 'required|mimes:mp4,mov,avi|max:1024000', // Max 10GB
        ]);

        $videoPath = $request->file('video')->store('videos', 'public');

        Video::create([
            'title' => $request->title,
            'video_path' => $videoPath,
        ]);

        return redirect()->route('videos.index')->with('success', 'Video uploaded successfully.');
    }

    public function show($id)
    {
        $video = Video::findOrFail($id);

        return view('admin.videos.show', compact('video'));
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);

        return view('admin.videos.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $video = Video::findOrFail($id);

        $video->update([
            'title' => $request->title,
        ]);

        return redirect()->route('videos.index')->with('success', 'Video updated successfully.');
    }

    public function destroy($id)
      {
          $video = Video::findOrFail($id);

          // Delete the video file from storage
          Storage::disk('public')->delete($video->video_path);

          // Delete the video record from the database
          $video->delete();

          return redirect()->route('videos.index')->with('success', 'Video deleted successfully.');
      }


  
  
  
  
  
  
  
  
  
  
}
