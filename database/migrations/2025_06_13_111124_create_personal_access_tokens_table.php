<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Anoniminė klasė, kuri apibrėžia duomenų bazės migracijos logiką
return new class extends Migration
{
    /**
     * Ši funkcija paleidžiama, kai vykdoma migracija – t. y., kai norime keisti DB struktūrą.
     * Ji prideda papildomus laukus 2FA (dviejų faktorių autentifikacijai) prie `users` lentelės.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Pridedamas `two_factor_secret` stulpelis, kuris saugos slaptažodžio dalį 2FA
            $table->text('two_factor_secret')
                ->after('password') // įrašomas po "password" stulpelio
                ->nullable();       // leidžiama palikti tuščią

            // Pridedami `two_factor_recovery_codes` – atsarginiai kodai 2FA prisijungimui
            $table->text('two_factor_recovery_codes')
                ->after('two_factor_secret')
                ->nullable();

            // Pridedamas laukas `two_factor_confirmed_at` – data, kada 2FA buvo aktyvuotas
            $table->timestamp('two_factor_confirmed_at')
                ->after('two_factor_recovery_codes')
                ->nullable();
        });
    }

    /**
     * Ši funkcija paleidžiama, kai migracija atšaukiama (rollback).
     * Ji pašalina iš `users` lentelės visus papildytus stulpelius, susijusius su 2FA.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Pašalinami trys 2FA stulpeliai iš vartotojų lentelės
            $table->dropColumn([
                'two_factor_secret',
                'two_factor_recovery_codes',
                'two_factor_confirmed_at',
            ]);
        });
    }
};
