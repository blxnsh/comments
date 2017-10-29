<?php

namespace App;

use Validator;

class Validation {

  public $validator;

  function __construct($value) {
    $this->validator = Validator::make($value->all(), ['level' => 'required',
                               'parent_id' => 'required',
                               'body' => 'required',]);
   }


  public function commentFails(){
    return $this->validator->fails();
   }
}
