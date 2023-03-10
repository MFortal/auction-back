<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('private_entrepreneurs', function (Blueprint $table) {
            $table->id();
            $table->string('email', 255)->unique();
            $table->string('organization_name', 255)->nullable(false);

            $table->foreign('email')->references('email')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('private_entrepreneurs');
    }
};
