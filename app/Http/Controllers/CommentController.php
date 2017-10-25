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
       $this->validate($request, ['level' => 'required',
                                  'parent_id' => 'required',
                                  'body' => 'required',]);

        $comment = Comment::create(['parent_id' => $request->parent_id,
                                    'level' => $request->level,
                                    'body' => $request->body,]);
        return $comment;
     }

     public function deleteComment(Request $request)
      {
          Comment::find($request->id)->delete();
          return "true";
      }

     public function updateComment(Request $request)
      {
           $updcomment = Comment::find($request->id)->update($request->all());
          return "true";
      }
}
