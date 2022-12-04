<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dept')->nullable();
            $table->string('maktob_no');
            $table->text('subject');
            $table->string('status');
            $table->string('reject_no')->nullable();
            $table->string('reject_date')->nullable();
            $table->string('reject_subject')->nullable();
            $table->string('source')->nullable();
            $table->string('analyzed_no')->nullable();
            $table->string('claim_no')->nullable();
            $table->string('claim_date')->nullable();
            $table->text('claim')->nullable();
            $table->string('claim_files')->nullable();
            $table->string('auditors')->nullable();
            $table->string('group_no')->nullable();
            $table->string('group_date')->nullable();
            $table->string('group_recived_date')->nullable();
            $table->string('authority_date')->nullable();
            $table->string('hukm_no')->nullable();
            $table->string('hukm_date')->nullable();
            $table->text('hukm')->nullable();
            $table->string('board_no')->nullable();
            $table->string('board_date')->nullable();
            $table->string('board_files')->nullable();
            $table->string('result_no')->nullable();
            $table->string('result_date')->nullable();
            $table->text('result')->nullable();
            $table->string('send_no')->nullable();
            $table->string('send_date')->nullable();
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
        Schema::dropIfExists('claims');
    }
}
