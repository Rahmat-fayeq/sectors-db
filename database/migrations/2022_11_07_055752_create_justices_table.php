<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJusticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('justices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dept')->nullable();
            $table->string('maktob_no');
            $table->string('source')->nullable();
            $table->string('auditors')->nullable();
            $table->text('subject')->nullable();
            $table->string('sug_no')->nullable();
            $table->string('sug_date')->nullable();
            $table->string('board_no')->nullable();
            $table->string('board_date')->nullable();
            $table->text('result')->nullable();
            $table->string('result_no')->nullable();
            $table->string('result_date')->nullable();
            $table->string('judge_no')->nullable();
            $table->string('judge_date')->nullable();
            $table->string('file')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->foreign('dept')->references('id')->on('departments')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('justices');
    }
}
