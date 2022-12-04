<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectorAnalyseReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sector_analyse_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dept')->nullable();
            $table->string('maktob_no');
            $table->string('send_report_no');
            $table->string('send_report_date');
            $table->text('send_report_subject');
            $table->string('receive_report_no')->nullable();
            $table->string('receive_report_date')->nullable();
            $table->text('receive_report_subject')->nullable();
            $table->string('status')->nullable();
            $table->string('send_verify_date')->nullable();
            $table->string('receive_verify_date')->nullable();
            $table->string('export_date')->nullable();
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
        Schema::dropIfExists('sector_analyse_reports');
    }
}
