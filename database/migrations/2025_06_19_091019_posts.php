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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamp('publishdate')->nullable();
            $table->string('slug');
            $table->string('titleID');
            $table->string('titleEN');
            $table->string('descID');
            $table->string('descEN');
            $table->string('img');
            $table->string('category');
            $table->text('contentID');
            $table->text('contentEN');
            $table->string('tags');
            $table->integer('is_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('posts');
    }
};
