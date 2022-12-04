<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectorSavedMaktobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sector_saved_maktobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dept')->nullable();
            $table->string('maktob_no');
            $table->string('doc_no')->nullable();
            $table->string('shelf_no')->nullable();
            $table->string('shelf_row')->nullable();
            $table->string('year')->nullable();
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
        Schema::dropIfExists('sector_saved_maktobs');
    }
}
