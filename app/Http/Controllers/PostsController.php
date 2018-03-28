<?php

namespace App\Http\Controllers;
use App\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;

class PostsController extends Controller
{

    /**
     * Create a new controller instance.
       except is to specify routes that are not authenticated
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fetch all posts
        $posts=Post::orderby('created_at','desc')->get();

        //pass posts data to view
        return view('posts.index',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //load create form
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
        //validate post data
        $this->validate($request,[ 
            'title'=>'required',
            'body'=>'required',
            'post_image'=>'image|nullable|max:1999'
            ]);

        //handle file uploads
        if($request->hasFile('post_image'))
        {
            //get file name with extension
            $filenamewithExt=$request->file('post_image')->getClientOriginalName();
            //get filename only
            $filename=pathinfo($filenamewithExt,PATHINFO_FILENAME);
            //get extension only
            $extension=$request->file('post_image')->getClientOriginalExtension();
            $filenameToDB=$filename.'_'.time().'_'.$extension;
            $path=$request->file('post_image')->storeAs('public/post_photos',$filenameToDB);

        }
        else{

            $filenameToDB='nophoto.jpg';
        }


        //get post data
        $postData= new Post;
        //$postData=$request->all();
        $postData->title=$request->input('title');       
        $postData->body=$request->input('body');
        $postData->post_image=$filenameToDB;
        $postData->user_id=auth()->user()->id;

        //insert post dta
       //Post::create($postData);
        $postData->save();

        //store status message
        Session::flash('success_msg','Post added successfully');

        return redirect()->route('posts.index');

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //fetch post data
        $post=Post::find($id);

        //pass data to details view
        return view('posts.details',['post'=>$post]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get post data
        $post=Post::find($id);

        //load data in view
        return view('posts.edit',['post'=>$post]);
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
          //validate post data
        $this->validate($request,[ 
            'title'=>'required',
            'body'=>'required',
            'post_image'=>'image|nullable|max:1999'
            ]);

             //handle file uploads
        if($request->hasFile('post_image'))
        {
            //get file name with extension
            $filenamewithExt=$request->file('post_image')->getClientOriginalName();
            //get filename only
            $filename=pathinfo($filenamewithExt,PATHINFO_FILENAME);
            //get extension only
            $extension=$request->file('post_image')->getClientOriginalExtension();
            $filenameToDB=$filename.'_'.time().'_'.$extension;
            $path=$request->file('post_image')->storeAs('public/post_photos',$filenameToDB);

        }
    

        
        //get post data
        $postData= Post::find($id);
        $postData->title=$request->input('title');       
        $postData->body=$request->input('body');
        if($request->hasFile('post_image'))
        {
            $postData->post_image=$filenameToDB;
        }
        $postData->user_id=auth()->user()->id;

        //update post dta
       $postData->save();

        //store status message
        Session::flash('success_msg','Post updated  successfully');

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     
        //delete post dta
       $postData=Post::find($id);

       //check for correct user
       if(auth()->user()->id!==$postData->user_id)
       {
            return redirect('/posts')->with('error','You have no permisions to view requested page!');

       }

       if($postData->photo_image!='noimage.jpg')
       {
            //delete image from store
            Storage::delete('public/post_photos/'.$postData->post_image);

       }

       $postData->delete();

        //store status message
        Session::flash('success_msg','Post deleted successfully');

        return redirect()->route('posts.index');
    }
}
