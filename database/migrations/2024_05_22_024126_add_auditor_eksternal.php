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
        Schema::table('ofi', function (Blueprint $table) {
            $table->string('auditor_eksternal')->nullable()->after('diusulkan_oleh');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ofi', function (Blueprint $table) {
            $table->dropColumn('auditor_eksternal');
        });
    }
};
