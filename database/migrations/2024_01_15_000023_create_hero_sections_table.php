<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeroSectionsTable extends Migration
{
    public function up()
    {
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('main_title');
            $table->string('main_title_description');
            $table->string('main_button_title');
            $table->string('main_button_link');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
