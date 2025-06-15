<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migracijos klasė, kuri sukuria „transactions“ lentelę – saugoti pajamoms ir išlaidoms.
return new class extends Migration {

    //  Ši funkcija vykdoma paleidus migraciją (php artisan migrate)
    public function up(): void {
        // Sukuriama lentelė „transactions“
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // Automatinis unikalus ID (pirminis raktas)

            $table->foreignId('user_id')                     // Ryšys su vartotoju
                  ->constrained()                            // susieta su „users“ lentele
                  ->onDelete('cascade');                     // jei vartotojas bus ištrintas – ištrins ir įrašus

            $table->foreignId('category_id')                 // Ryšys su kategorija
                  ->constrained()                            // susieta su „categories“ lentele
                  ->onDelete('cascade');                     // jei kategorija ištrinta – ištrins ir įrašus

            $table->decimal('amount', 10, 2); // Suma su 2 skaičiais po kablelio (pvz. 1234.56)

            $table->date('date'); // Data, kada įvyko transakcija

            $table->string('description')->nullable(); // Aprašymas, gali būti tuščias

            $table->timestamps(); // Laravel automatiškai prideda „created_at“ ir „updated_at“ stulpelius
        });
    }

    //  Ši funkcija vykdoma atšaukiant migraciją (php artisan migrate:rollback)
    public function down(): void {
        // Pašalina „transactions“ lentelę, jei egzistuoja
        Schema::dropIfExists('transactions');
    }
};
