<?php

namespace App\Providers;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use App\Util\CategoryTreeOutput;

class CategoryTreeProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->singleton(CategoryTreeOutput::class, function ($app) {
//            return new CategoryTreeOutput();
//        });
        App::bind('categorytree', function()
        {
            return new CategoryTreeOutput(new Request);
        });    
            
    }
    
    
}
