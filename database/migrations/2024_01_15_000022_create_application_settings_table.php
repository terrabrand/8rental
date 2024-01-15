<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('application_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('application_name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
