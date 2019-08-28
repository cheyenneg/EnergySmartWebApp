<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Energy extends Model
{
    // TODO: Fillable?
    protected $table = "energy";
    protected $primaryKey = "e_id";

    public function user()
    {
      return $this->belongsTo('App\User', 'u_id');
    }

}
