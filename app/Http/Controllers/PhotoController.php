<?php

namespace App\Http\Controllers;

use App\Photo;
/*---library----*/
use ImageResize;
/*-------------*/
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function __construct(){}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
        return view('images.index');
    }

    public function all(){
        return view('images.all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('images.create',['photo'=>new Photo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $fields = request()->validate([
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,bmp,jpg,gif,svg|max:2048',
        ]);
        
        $file = $request->image->getClientOriginalName();
        // Get just filename without extension (raw PHP)
        $name = pathinfo($file, PATHINFO_FILENAME);
        // Get just ext
        $extension = $request->image->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $name . '_' . date('YmdHis') . '.' . $extension;
        $request->image->move(public_path('uploads'), $fileNameToStore);
        //Get image from uploads and save thumbnail
        ImageResize::make(public_path('uploads').'/'.$fileNameToStore)->resize(250,250,null,TRUE)->save(public_path('uploads/thumbnail').'/'.$fileNameToStore);
        $fields['image'] = $fileNameToStore;
        Photo::create($fields);
        // Upload Image
        
        return redirect()->route('photos.index')->with('success','Your image is uploaded successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        return view('images.show',['photo'=>$photo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        return view('images.edit',['photo'=>$photo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        $fields = Request()->validate([
            'name' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048'
        ]);
        
        if ($request->hasfile('image')) {
            //Get previous image
            $img = public_path('uploads\\' . $photo->image);
            $_img = public_path('uploads\thumbnail\\' . $photo->image);
            //if(File::exists($img){
            //if($post->exists($img)){
            if (file_exists($img)) {
                //File::delete('public/images/'.$post->image_url);
                @chmod($img, 0755);
                //@unlink($img);
                unlink($img);
            }
            if (file_exists($_img)) {
                //File::delete('public/images/'.$post->image_url);
                @chmod($_img, 0755);
                //@unlink($img);
                unlink($_img);
            }

            $file = $request->image->getClientOriginalName();
            // Get just filename
            $name = pathinfo($file, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->image->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $name . '_' . date('YmdHis') . '.' . $extension;
            // Upload Image
            $request->image->move(public_path('uploads'), $fileNameToStore);
            //Get image from uploads and save thumbnail
            ImageResize::make(public_path('uploads').'/'.$fileNameToStore)->resize(250,250,null,TRUE)->save(public_path('uploads/thumbnail').'/'.$fileNameToStore);
            $fields['image'] = $fileNameToStore;
        }
        $photo->update($fields);
        return back()->with('success','Your image was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        //Get previous image
        $img = public_path('uploads\\' . $photo->image);
        $_img = public_path('uploads\thumbnail\\' . $photo->image);
        //if(File::exists($img){
        //if($post->exists($img)){
        if (file_exists($img)) {
            //File::delete('public/images/'.$post->image_url);
            @chmod($img, 0755);
            //@unlink($img);
            unlink($img);
        }
        if (file_exists($_img)) {
            //File::delete('public/images/'.$post->image_url);
            @chmod($_img, 0755);
            //@unlink($img);
            unlink($_img);
        }
        $photo->delete();
        return back()->with('success','Your image was deleted successfully!');
    }
}
