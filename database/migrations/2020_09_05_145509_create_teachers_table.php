<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();

            $table->string('name', 60);
            $table->date('birthday');

            $table->bigInteger('lesson_id')->unsigned()->nullable();
            $table->bigInteger('grade_id')->unsigned()->nullable();

            $table->foreign('lesson_id')->references('id')->on('lessons')->nullOnDelete();
            $table->foreign('grade_id')->references('id')->on('grades')->nullOnDelete();

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
        Schema::dropIfExists('teachers');
    }
}
