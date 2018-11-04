<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{

    protected $table = 'companies';

    protected $fillable = [
      'name', 'email', 'tel', 'address'
    ];

    public function users(){
      return $this->hasMany('App\User');
    }
}
