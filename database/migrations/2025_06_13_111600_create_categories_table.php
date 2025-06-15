<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Ši migracija sukuria lentelę „categories“, skirtą pajamų ir išlaidų kategorijoms saugoti.
return new class extends Migration {

    // 👇 Ši funkcija sukuriama, kai vykdoma migracija (php artisan migrate)
    public function up(): void {
        // Sukuriama lentelė „categories“
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Automatinis pirminis raktas ID

            $table->string('name'); // Kategorijos pavadinimas (pvz. „Maistas“, „Atlyginimas“)

            $table->enum('type', ['pajamos', 'islaidos']); 
            // Nurodo ar tai pajamų ar išlaidų kategorija

            $table->timestamps(); // Laravel automatiškai pridės „created_at“ ir „updated_at“ stulpelius
        });
    }

    // 👇 Ši funkcija paleidžiama, kai migracija atšaukiama (php artisan migrate:rollback)
    public function down(): void {
        // Jei reikia panaikinti šią lentelę – ji bus ištrinta
        Schema::dropIfExists('categories');
    }
};
