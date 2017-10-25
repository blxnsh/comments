<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $fillable = ['parent_id', 'level', 'body'];

  public function replies() {
      return $this->hasMany(Comment::class, 'parent_id');
    }
}
