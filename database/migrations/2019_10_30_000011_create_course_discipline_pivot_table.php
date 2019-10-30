<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseDisciplinePivotTable extends Migration
{
    public function up()
    {
        Schema::create('course_discipline', function (Blueprint $table) {
            $table->unsignedInteger('course_id');

            $table->foreign('course_id', 'course_id_fk_538846')->references('id')->on('courses')->onDelete('cascade');

            $table->unsignedInteger('discipline_id');

            $table->foreign('discipline_id', 'discipline_id_fk_538846')->references('id')->on('disciplines')->onDelete('cascade');
        });
    }
}
