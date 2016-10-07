<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    
    use NodeTrait;
    use Translatable;
    //public $translationModel = 'MyApp\Models\CountryAwesomeTranslation';
    
    protected $table = 'category';
    
    public $translatedAttributes = ['title','description'];
    protected $fillable = ['slug','parent_id'];    
}
