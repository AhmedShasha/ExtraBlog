<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->name = $request->get('name');
        $comment->comment = $request->get('comment_body');
        $post = Post::find($request->get('post_id'));
        $post->comments()->save($comment);

        return back();
    }
}
