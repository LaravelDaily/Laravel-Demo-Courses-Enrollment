<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEnrollmentsTable extends Migration
{
    public function up()
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->unsignedInteger('user_id');

            $table->foreign('user_id', 'user_fk_538851')->references('id')->on('users');

            $table->unsignedInteger('course_id');

            $table->foreign('course_id', 'course_fk_538852')->references('id')->on('courses');
        });
    }
}
