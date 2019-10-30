<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('institution_id')->nullable();

            $table->foreign('institution_id', 'institution_fk_538818')->references('id')->on('institutions');
        });
    }
}
