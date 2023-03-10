<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('juridical_people', function (Blueprint $table) {
            $table->id();
            $table->string('email', 255)->unique();
            $table->string('organization_name', 255)->unique()->nullable(false);
            $table->string('first_name', 255)->nullable(false);
            $table->string('last_name', 255)->nullable(false);
            $table->string('patronymic', 255);

            $table->foreign('email')->references('email')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('juridical_people');
    }
};
