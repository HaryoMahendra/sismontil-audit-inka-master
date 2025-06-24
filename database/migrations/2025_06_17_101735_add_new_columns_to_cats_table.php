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
    Schema::table('cats', function (Blueprint $table) {
        if (!Schema::hasColumn('cats', 'is_cat')) {
            $table->enum('is_cat', ['Ya', 'Tidak'])->nullable();
        }
        if (!Schema::hasColumn('cats', 'tanggal')) {
            $table->date('tanggal')->nullable();
        }
        // Tambah kolom lainnya dengan pengecekan juga
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cats', function (Blueprint $table) {
            //
        });
    }
};
