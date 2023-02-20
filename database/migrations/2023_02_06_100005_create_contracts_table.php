<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('rent', 15, 0);
            $table->decimal('deposit', 15, 0);
            $table->unsignedBigInteger('tenant_id');
            // $table->unsignedBigInteger('landlord_id');
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tenant_id')->references('id')->on('tenants');
            // $table->foreign('landlord_id')->references('id')->on('users');
            $table->foreign('property_id')->references('id')->on('properties');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contracts');
    }
};