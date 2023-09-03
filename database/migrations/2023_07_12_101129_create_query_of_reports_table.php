<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('query_of_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('report_category_id')->default(1); // To Make a Real One First 
            $table->foreign('report_category_id')->references('id')->on('report_categories')->cascadeOnDelete();
            $table->string('query_title');
            $table->longText("sql_query_string"); // To Store the SQL Query
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('query_of_reports');
    }
};