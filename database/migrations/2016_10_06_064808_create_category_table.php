<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });
        Schema::create('category_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->string('title');
            $table->string('description');
            $table->string('locale')->index();

            $table->unique(['category_id','locale']);
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');            
        });    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('category');
        Schema::drop('category_translation');
    }
}
