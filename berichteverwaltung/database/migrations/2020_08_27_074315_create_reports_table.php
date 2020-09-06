<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_book_id');
            $table->enum('type',['daily','weekly','monthly']);
            $table->integer('position')->default(1)->nullable();
            $table->date('begin_date');
            $table->date('end_date');
            $table->string('company')->nullable();
            $table->string('department')->nullable();
            $table->double('hours_targeted')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
