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
// database/migrations/xxxx_xx_xx_create_clients_table.php
Schema::create('clients', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->text('address');
    $table->date('payment_date');
    $table->date('due_date');
    $table->foreignId('package_id')->constrained()->onDelete('cascade');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
