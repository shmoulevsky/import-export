<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_logs', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('total_count')->unsigned()->nullable();
            $table->bigInteger('success_count')->unsigned()->nullable();
            $table->bigInteger('error_count')->unsigned()->nullable();

            $table->bigInteger('result_id')->unique()->unsigned()->nullable();
            $table->foreign('result_id')
                ->references('id')->on('results')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('result_logs');
    }
};
