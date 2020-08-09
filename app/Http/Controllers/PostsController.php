<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Storage;
use DB;
class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth' , ['except' => ['index','show']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // get all posts from the Post model
        $posts =  Post::orderBy('created_at','desc')->paginate(10);
        // return the view
        return view('posts.index')->with('posts' , $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the post data before storing it
        $this->validate($request , [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle file upload

        if ($request->hasFile('cover_image')){
            $filename_with_extension = $request->file('cover_image')->getClientOriginalName();
            // get just the name
            $filename = pathinfo($filename_with_extension , PATHINFO_FILENAME);
            // get extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // file name to store in DB
            $filename_to_store = $filename.'_'.time().'.'.$extension;
            // upload the image to the storage
            $path = $request->file('cover_image')->storeAs('public/cover_images' , $filename_to_store);
            /* in order to be able to display the image through the browser we need to link
            that storage directory to public folder through artsan command
            php artisan storage:link
            */
        }else{
            $filename_to_store = 'noimage.jpg';
        }
        
        // store the post 
        $post = new Post ;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $filename_to_store;
        $post->save();

        return redirect('../posts')->with('success' , 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get the post with that id
        $post = Post::find($id);
        // return the view
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get the post 
        $post = Post::find($id);

        // check if the user owns that post or not 
        if (auth()->user()->id == $post->user_id){
            // return the view
            return view ('posts.edit')->with('post',$post);
        }else{
            return redirect('/posts')->with('error' , 'you cannot edit other people posts');
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
        // validate the cells 
        $this->validate($request , [
            'title' => 'required',
            'body' => 'required'
        ]);

        // Handle file upload

        if ($request->hasFile('cover_image')){

            $check = TRUE ; 

            $filename_with_extension = $request->file('cover_image')->getClientOriginalName();
            // get just the name
            $filename = pathinfo($filename_with_extension , PATHINFO_FILENAME);
            // get extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // file name to store in DB
            $filename_to_store = $filename.'_'.time().'.'.$extension;
            // upload the image to the storage
            $path = $request->file('cover_image')->storeAs('public/cover_images' , $filename_to_store);
            /* in order to be able to display the image through the browser we need to link
            that storage directory to public folder through artsan command
            php artisan storage:link
            */
        }

        // save the updated info
        $post = Post::find($id) ;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if ($check){
            $post->cover_image = $filename_to_store;
        }
        $post->save();

        return redirect('../posts')->with('success' , 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get the post 
        $post = Post::find($id);
        // check if the user owns that post
        if (auth()->user()->id == $post->user_id){
            $post->delete();
            // delete the image
            if ($post->cover_image != 'noimage.jpg') {
                Storage::delete('public/cover_images/'.$post->cover_image);
            }
            return redirect('/posts')->with('success' , 'Post Deleted');
        }else{
            return redirect('/posts')->with('error' , 'you cannot delete other people posts');
        }
    }
}
