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
        Schema::create('ebooks', function (Blueprint $table) {
            $table->id();
            $table->text('ebook_name');
            $table->string('ebook_file');
            $table->string('ebook_cover')->nullable();
            $table->enum('ebook_ver', ['1.0', '2.0', '3.0', '4.0', '5.0']);
            $table->enum('status', ['on', 'off'])->default('on');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ebooks');
    }
};
