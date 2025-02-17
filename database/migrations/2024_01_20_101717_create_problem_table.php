<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('problem', function (Blueprint $table) {
            $table->id();
            $table->string('problem_name');
            $table->string('p_img');
            $table->string('p_detail');
            $table->string('p_location');
            $table->string('p_date');
            $table->unsignedBigInteger('user_p_id');
            $table->timestamps();

            $table->foreign('user_p_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('problem');
    }
};
