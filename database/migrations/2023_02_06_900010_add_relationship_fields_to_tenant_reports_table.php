<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tenant_reports', function (Blueprint $table) {
            $table->unsignedBigInteger('nationality')->nullable();
            $table->foreign('nationality')->references('id')->on('countries');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('tenant_reports', function (Blueprint $table) {
            $table->dropForeign('tenant_reports_nationality_foreign');
            $table->dropForeign('tenant_reports_created_by_foreign');
        });
    }
};
