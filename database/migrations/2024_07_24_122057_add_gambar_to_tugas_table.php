<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGambarToTugasTable extends Migration
{
    public function up()
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->string('gambar')->nullable()->after('file');
        });
    }

    public function down()
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->dropColumn('gambar');
        });
    }
}

