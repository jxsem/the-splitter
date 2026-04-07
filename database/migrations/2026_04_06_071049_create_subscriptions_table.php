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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            //El usuario que paga la factura principal
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            //El servicio contratado
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->decimal('price', 8, 2); // Aquí es donde vive el dinero
            $table->date('renewal_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
