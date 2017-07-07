<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use DB;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //$post = Post::where('title', 'Post Two')->get();
        //$posts = DB::select('SELECT * FROM posts');//using strictly sql rather than eloquent 

        
        //$posts = Post::orderBy('title', 'desc')->take(1)->get();
        //$posts = Post::orderBy('title', 'desc')->get();//eloquent fetch command to pass all data from the table
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image'=> 'image|nullable|max:1999'
        ]); 

        //Handle File Upload

        if($request->hasFile('cover_image')){
            //Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get filename only
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get Extension only
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore =$filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        //Create Post
        $post = new Post;
        $post->title = $request->input('title');//retrieves input data from title
        $post->body = $request->input('body');//retrieves input from body
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        //Check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        return view('posts.edit')->with('post', $post);
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
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        //Handle File Upload

        if($request->hasFile('cover_image')){

            if ($request->hasFile('cover_image')) { 
                if ($post->cover_image != 'noimage.jpg'){
                     Storage::delete('public/cover_images/'.$post->cover_image);
                      } 
                      $post->cover_image = $filenameToStore; 
                      }
            //Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get filename only
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get Extension only
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore =$filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } 

        //Create Post
        $post = Post::find($id);
        $post->title = $request->input('title');//retrieves input data from title
        $post->body = $request->input('body');//retrieves input from body
         if($request->hasFile('cover_image')){
             $post->cover_image = $fileNameToStore;
         }
        $post->save();

        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');

        //Check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        if($post->cover_image != 'noimage.jpg'){
            //Delete Image
            Storage::delete('public/cover_image'.$post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');
    }    
}
