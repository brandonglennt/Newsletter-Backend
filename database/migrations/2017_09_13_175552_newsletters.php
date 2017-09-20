<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Newsletters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::create('newsletters', function(Blueprint $table) {
       $table->increments('id');
       $table->string('title');
       $table->string('companyName');
       $table->string('url');
       $table->longText('description');
       $table->longText('logo');
       $table->timestamps();
     });
    }

     /**
      * Reverse tthe migrations.
      *
      * @return void
      */
    public function down()
     {
       Schema::drop('newsletters');
     }
   }
   
