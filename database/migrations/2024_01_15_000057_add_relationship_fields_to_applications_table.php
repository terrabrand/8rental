<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToApplicationsTable extends Migration
{
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_9390123')->references('id')->on('users');
            $table->unsignedBigInteger('property_applying_id')->nullable();
            $table->foreign('property_applying_id', 'property_applying_fk_9390125')->references('id')->on('properties');
            $table->unsignedBigInteger('unit_applying_id')->nullable();
            $table->foreign('unit_applying_id', 'unit_applying_fk_9390124')->references('id')->on('units');
        });
    }
}
