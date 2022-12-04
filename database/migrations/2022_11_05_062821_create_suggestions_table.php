<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuggestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suggestions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dept')->nullable();
            $table->string('sug_no');
            $table->string('sug_date');
            $table->text('sug_subject');
            $table->string('sug_verify_date')->nullable();
            $table->string('sug_status')->nullable();
            $table->string('file')->nullable();
            $table->text('sug_remarks')->nullable();
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
        Schema::dropIfExists('suggestions');
    }
}
