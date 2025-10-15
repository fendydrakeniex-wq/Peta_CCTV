<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('lat');
            $table->double('lon');
        });

        Schema::create('cctvs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade');
            $table->string('name');
            $table->text('url');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cctvs');
        Schema::dropIfExists('locations');
    }
};
