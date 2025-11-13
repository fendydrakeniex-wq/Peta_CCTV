<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel lokasi
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('lat', 10, 6);
            $table->double('lon', 10, 6);
            $table->timestamps();
        });

        // Tabel CCTV
        Schema::create('cctvs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')
                    ->constrained('locations')
                    ->onDelete('cascade');
            $table->string('name');
            $table->string('ip_address')->nullable();
            $table->integer('port')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('protocol')->nullable();
            $table->text('url')->nullable();
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('cctvs');
        Schema::dropIfExists('locations');
    }
};
