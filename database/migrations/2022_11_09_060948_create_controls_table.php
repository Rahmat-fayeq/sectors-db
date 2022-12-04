<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dept')->nullable();
            $table->string('source')->nullable();
            $table->string('auditors')->nullable();
            $table->string('date')->nullable();
            $table->string('controller')->nullable();
            $table->string('type')->nullable();
            $table->string('step')->nullable();
            $table->text('progress')->nullable();
            $table->text('result')->nullable();
            $table->text('decision')->nullable();
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
        Schema::dropIfExists('controls');
    }
}
