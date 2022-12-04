<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectorSourceReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sector_source_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dept')->nullable();
            $table->unsignedBigInteger('city')->nullable();
            $table->string('source');
            $table->string('maktob_no');
            $table->string('report_no');
            $table->string('report_date');
            $table->text('report_subject');
            $table->string('doc_no')->nullable();
            $table->string('shelf_no')->nullable();
            $table->string('shelf_row')->nullable();
            $table->string('year')->nullable();
            $table->string('file')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->foreign('dept')->references('id')->on('departments')->nullOnDelete();
            $table->foreign('city')->references('id')->on('cities')->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sector_source_reports');
    }
}
