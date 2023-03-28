<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('e_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('thumbnail_url');
            $table->integer('size');
            $table->string('occasion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_cards');
    }
};
