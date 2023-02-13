<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tenant_reports', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->unsignedBigInteger('nationality')->nullable();
            $table->string('passport')->nullable();
            $table->string('id_card')->nullable();
            $table->date('dob');
            $table->integer('n_months');
            $table->string('lease_broken');
            $table->decimal('outstanding_rent', 15, 2);
            $table->string('property_damaged');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('nationality')->references('id')->on('countries');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tenant_reports');
    }
};
