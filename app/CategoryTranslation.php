<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    public $timestamps = false;
    
    protected $table = 'category_translation';
    
    protected $fillable = ['title','description'];
}
