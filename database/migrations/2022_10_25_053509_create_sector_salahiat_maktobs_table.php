<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectorSalahiatMaktobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sector_salahiat_maktobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dept')->nullable();
            $table->string('maktob_no');
            $table->string('hukm_no')->nullable();
            $table->string('hukm_date')->nullable();
            $table->string('audit_dept');
            $table->string('audit_year');
            $table->string('audited_year');
            $table->string('quarter');
            $table->string('head_auditor')->nullable();
            $table->string('auditor1')->nullable();
            $table->string('auditor2')->nullable();
            $table->string('auditor3')->nullable();
            $table->string('auditor4')->nullable();
            $table->string('auditor5')->nullable();
            $table->string('auditor6')->nullable();
            $table->string('city_id');
            $table->string('start_date');
            $table->string('end_date');
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
        Schema::dropIfExists('sector_salahiat_maktobs');
    }
}
