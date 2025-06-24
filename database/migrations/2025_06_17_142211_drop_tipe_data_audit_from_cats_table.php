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
        $table->dropColumn('tipe_data_audit');
    });
}

public function down()
{
    Schema::table('cats', function (Blueprint $table) {
        $table->string('tipe_data_audit');
    });
}

};
