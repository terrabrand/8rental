<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPropertiesTable extends Migration
{
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->unsignedBigInteger('landlord_id')->nullable();
            $table->foreign('landlord_id', 'landlord_fk_9387106')->references('id')->on('landlords');
            $table->unsignedBigInteger('maintainer_id')->nullable();
            $table->foreign('maintainer_id', 'maintainer_fk_9388016')->references('id')->on('maintainers');
        });
    }
}
