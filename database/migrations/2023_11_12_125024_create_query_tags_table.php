<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('query_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('query_id');
            $table->foreign('query_id')->references('id')->on('query_of_reports')->cascadeOnDelete();
            $table->string('tag')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('query_tags');
    }
};
