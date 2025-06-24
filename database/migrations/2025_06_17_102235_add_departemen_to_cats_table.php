<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('cats', function (Blueprint $table) {
        if (!Schema::hasColumn('cats', 'departemen')) {
            $table->string('departemen')->nullable();
        }
    });
}

public function down()
{
    Schema::table('cats', function (Blueprint $table) {
        $table->dropColumn('departemen');
    });
}

};
