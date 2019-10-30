<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionsTable extends Migration
{
    public function up()
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->unique();

            $table->longText('description')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
