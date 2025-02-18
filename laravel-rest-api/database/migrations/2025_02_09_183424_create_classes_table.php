<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('classes', function (Blueprint $table) {
        $table->id();
        $table->string('grup');  // Afegeix el camp grup
        $table->string('tutor');
        $table->timestamps(); // crea les columnes 'created_at' i 'updated_at'
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
