<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUnitsTable extends Migration
{
    public function up()
    {
        Schema::table('units', function (Blueprint $table) {
            $table->unsignedBigInteger('unit_property_id')->nullable();
            $table->foreign('unit_property_id', 'unit_property_fk_9387132')->references('id')->on('properties');
            $table->unsignedBigInteger('unit_section_id')->nullable();
            $table->foreign('unit_section_id', 'unit_section_fk_9387133')->references('id')->on('sections');
        });
    }
}
