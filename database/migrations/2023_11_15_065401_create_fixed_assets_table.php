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
        Schema::create('fixed_assets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('sub_category_id')->index()->constrained();
            $table->foreignId('specific_location_id')->index()->constrained();
            $table->foreignId('procurement_id')->index()->constrained();
            $table->foreignId('unit_id')->index()->constrained();
            $table->foreignId('user_id')->index()->constrained();
            $table->string('kode_bmn')->nullable();
            $table->string('kode_sn')->nullable();
            $table->string('kondisi');
            $table->string('tahun_perolehan');
            $table->string('qrcode')->nullable();
            $table->string('harga')->nullable();
            $table->string('keterangan')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixed_assets');
    }
};