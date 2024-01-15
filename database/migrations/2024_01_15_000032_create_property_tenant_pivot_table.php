<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyTenantPivotTable extends Migration
{
    public function up()
    {
        Schema::create('property_tenant', function (Blueprint $table) {
            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id', 'property_id_fk_9388015')->references('id')->on('properties')->onDelete('cascade');
            $table->unsignedBigInteger('tenant_id');
            $table->foreign('tenant_id', 'tenant_id_fk_9388015')->references('id')->on('tenants')->onDelete('cascade');
        });
    }
}
