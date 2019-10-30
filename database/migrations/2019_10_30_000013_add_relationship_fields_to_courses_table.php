<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCoursesTable extends Migration
{
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->unsignedInteger('institution_id');

            $table->foreign('institution_id', 'institution_fk_538844')->references('id')->on('institutions');
        });
    }
}
