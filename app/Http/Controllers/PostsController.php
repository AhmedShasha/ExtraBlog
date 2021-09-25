<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\post;
// use Intervention\Image\Facades\Image;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use Auth;

class PostsController extends Controller
{
    // function middelware
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show', 'comment');
    }

    //  List posts with pagination
    public function index()
    {

        $posts = post::orderBy('id', 'desc')->paginate(5);
        $count = post::count();
        return view('posts.index', compact('posts', 'count'));
    }

    // Show More of this post
    public function show($id)
    {
        $posts = post::find($id);
        return view('posts.show', compact('posts'));
    }

    // Create new post
    public function create()
    {

        return view('posts.create');
    }
    // Store posts
    public function store(Request $req)
    {

//         if ($req->hasFile('image')) {
//             $file = $req->file('image');
//             $ext = $file->getClientoriginalExtension();
//             $filename = 'image' . '_' . time() . '.' . $ext;
//             $file->storeAs('public/storage/images', $filename);
//
//         } else {
//             $filename = 'public/storage/images/download.jpg';
//         }

        $req->validate([
            'title' => 'required|max:100',
            'body' => 'required|max:1000',
        ]);

        $post = new Post();
        $post->title = $req->title;
        $post->body = $req->body;
        // $post->image = $filename;

        $post->user_id = auth()->user()->id;

        $post->save();
        return redirect('/posts')->with('status', 'Post Was Created !');
    }

    // Edit Post
    public function edit($id)
    {
        $posts = post::find($id);
        if (auth()->user()->id !== $posts->user_id) {
            return redirect('/posts')->with('error', 'What are you doing here !!!!');
        }

        return view('posts.edit', compact('posts'));
    }
    // Update Post
    public function update(Request $request, $id)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientoriginalExtension();
            $filename = 'image' . '_' . time() . '.' . $ext;
            $file->storeAs('public/images', $filename);

        } else {
            $filename = 'noimage.jpg';
        }

        $request->validate([
            'title' => 'required|max:100',
            'body' => 'required|max:1000',
        ]);
        $post = post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->image = $filename;

        $post->save();
        return redirect('/posts')->with('status', 'Post Was Updated !');

    }
    // Delete Post
    public function destroy($id)
    {
        $post = post::find($id);
        $post->delete();

        return redirect('/posts')->with('status', 'Post Was Deleted !');
    }

}
