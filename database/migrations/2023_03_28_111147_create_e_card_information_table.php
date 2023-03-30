<?php

use App\Models\ECard;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('e_card_information', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ECard::class);
            $table->string('image_url');
            $table->json('assets')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_card_information');
    }
};
