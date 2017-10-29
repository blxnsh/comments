<?php

namespace App;

use App\Validation;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $fillable = ['parent_id', 'level', 'body'];

  public function replies() {
      return $this->hasMany(Comment::class, 'parent_id');
    }

  static public function createComment($value)
   {
     $validator = new Validation($value);

     if(!$validator->commentFails()){
     return Comment::create(['parent_id' => $value->parent_id,
                                 'level' => $value->level,
                                 'body' => $value->body,]);
      }
   }

  static public function deleteComment($value)
    {
      if (count(Comment::find($value->id)->replies()->get()) > 0) {
        $replies = Comment::find($value->id)->replies()->get();

        foreach($replies as $reply){
          if(count(Comment::find($reply->id)->replies()->get()) > 0){
              $repliesloop = Comment::find($reply->id)->replies()->get();
                foreach($repliesloop as $replyinloop){
                  Comment::find($replyinloop->id)->delete();
            }
          }
            Comment::find($reply->id)->delete();
        }
      }

      Comment::find($value->id)->delete();
    }

}
