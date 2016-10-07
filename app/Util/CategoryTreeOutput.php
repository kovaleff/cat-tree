<?php
namespace App\Util;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Category;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CategoryTreeOutput{
    
    public function __construct(Request $request) {
        $this->request = $request;
    }
    
    public function showTree(){
        $category_id =  basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        
        $current = '';
        if ($category_id) {
            $current= new Category();
            $current = $current->find($category_id);
            
            $root = Category::find($category_id);
            $nodes = $root->descendants->toTree($root);
        }
        else{
            $nodes = Category::get()->toTree();
        }

        $ret = [];
        $traverse = function ($categories, $prefix = '-') use (&$traverse, &$ret) {
            foreach ($categories as $category) {
                $ret[$category->id] = $prefix . ' ' . $category->title;
                $traverse($category->children, $prefix . '-');
            }
        };
        
        $traverse($nodes);

        print "<ul class='categories-list'>";
        foreach ( $ret as $key => $category ){
            print"<a href='/{$key}'><li class='category-itemt'>{$category}</li></a>";
        }
        print "</ul>";
            
    }
}