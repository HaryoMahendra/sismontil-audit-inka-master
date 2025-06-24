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
        Schema::create('cats', function (Blueprint $table) {
            $table->id();
            $table->enum('is_cat', ['Ya', 'Tidak']);
            $table->string('departemen');
            $table->text('penyelidikan')->nullable(); // format_cat_penyelidikan
            $table->text('perbaikan')->nullable();    // format_cat_perbaikan
            $table->text('rencana')->nullable();       // format_cat_rencana
            $table->string('verifikator');
            $table->date('tanggal'); // digunakan untuk sorting
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cats');
    }
};
