<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dbases', function (Blueprint $table) {
            $table->id();
            $table->string('db_name')->default('LB');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dbases');
    }
};
