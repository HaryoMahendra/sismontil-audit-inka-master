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
        Schema::table('ncr', function (Blueprint $table) {
            $table->string('auditor_eksternal')->nullable()->after('nama_auditor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ncr', function (Blueprint $table) {
            $table->dropColumn('auditor_eksternal');
        });
    }
};
