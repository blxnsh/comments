<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function home()
    {
        $comments = Comment::with('replies')->get();
        return view('main');
    }

    public function getComments()
    {
        $comments = Comment::with('replies')->get();
        return $comments;
    }

    public function postComment(Request $request)
    {
        $comment = Comment::createComment($request);
        return $comment;
    }

    public function deleteComment(Request $request)
    {
        Comment::deleteComment($request);
        return "true";
    }

    public function updateComment(Request $request)
    {
        Comment::find($request->id)->update($request->all());
        return "true";
    }
}
