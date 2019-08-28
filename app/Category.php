<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // TODO: fillable?
    protected $table = "category";
    protected $primaryKey = "cat_id";
}
