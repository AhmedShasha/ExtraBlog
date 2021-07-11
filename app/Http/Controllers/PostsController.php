<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Comment;
use App\post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use Auth;

class PostsController extends Controller
{
    // function middelware
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show','comment');
    }

    //  List posts with pagination
    public function index()
    {
        // $posts = post::orderBy('id','desc')->take(5);

        // $posts = DB::select('select * from posts', [1]);         // when use it remove pagination from index.blade

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

        if ($req->hasFile('image')) {
            $file = $req->file('image');
            $ext = $file->getClientoriginalExtension();
            $filename = 'image' . '_' . time() . '.' . $ext;
            $file->storeAs('public/images', $filename);

        } else {
            $filename = 'public/images/download.jpg';
        }

        $req->validate([
            'title' => 'required|max:100',
            'body' => 'required|max:1000',
        ]);

        $post = new Post();
        $post->title = $req->title;
        $post->body = $req->body;
        $post->image = $filename;

        // dd($post->image);

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

    //comment
//     public function comment(Request $req,$id)
//     {
//         $comment = new Comment();
//
//         $comment->name = $req->get('name');
//         $comment->comment = $req->get('comment');
//         // $comment->user()->associate($req->user());
//         $post = Post::find($req->get('post_id'));
//
//         $comment->post_id = $post = post::find($id);
//
//         dd($req->get('post_id'));
//         $comment->save();
//         // $post->comments()->save($comment);
//
//         return view('posts.show', compact('posts'));
//     }
}
