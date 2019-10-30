<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisciplinesTable extends Migration
{
    public function up()
    {
        Schema::create('disciplines', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->unique();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
