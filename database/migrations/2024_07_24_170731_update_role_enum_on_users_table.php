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
        Schema::table('users', function (Blueprint $table) {
            // Mengubah enum 'role' untuk menambahkan 'editor'
            $table->enum('role', ['admin', 'author', 'editor'])->default('author')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Mengembalikan enum ke nilai semula jika diperlukan
            $table->enum('role', ['admin', 'author'])->default('author')->change();
        });
    }
};
