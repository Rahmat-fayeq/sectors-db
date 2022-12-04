<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectorPlanMaktobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sector_plan_maktobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dept')->nullable();
            $table->string('maktob_no');
            $table->string('plan_no')->nullable();
            $table->string('plan_date')->nullable();
            $table->string('plan_status')->nullable();
            $table->string('quality')->nullable();
            $table->string('verify_date')->nullable();
            $table->string('rmaktob_no')->nullable();
            $table->string('rmaktob_date')->nullable();
            $table->text('rmaktob_subject')->nullable();
            $table->string('doc_no')->nullable();
            $table->string('shelf_no')->nullable();
            $table->string('shelf_row')->nullable();
            $table->string('year')->nullable();
            $table->text('remarks')->nullable();
            $table->string('file')->nullable();
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
        Schema::dropIfExists('sector_plan_maktobs');
    }
}
