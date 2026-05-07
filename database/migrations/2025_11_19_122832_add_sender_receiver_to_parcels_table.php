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
        Schema::table('parcels', function (Blueprint $table) {
            // Add sender information
            $table->string('sender_name')->nullable()->after('status');
            $table->string('sender_phone')->nullable()->after('sender_name');
            $table->string('sender_id_number')->nullable()->after('sender_phone');
            $table->string('sender_address')->nullable()->after('sender_id_number');
            
            // Add receiver information
            $table->string('receiver_name')->nullable()->after('sender_address');
            $table->string('receiver_phone')->nullable()->after('receiver_name');
            $table->string('receiver_id_number')->nullable()->after('receiver_phone');
            $table->string('receiver_address')->nullable()->after('receiver_id_number');
            
            // Add timestamps for delivery
            $table->timestamp('delivered_at')->nullable()->after('receiver_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parcels', function (Blueprint $table) {
            // Drop the added columns
            $table->dropColumn([
                'sender_name',
                'sender_phone',
                'sender_id_number',
                'sender_address',
                'receiver_name',
                'receiver_phone',
                'receiver_id_number',
                'receiver_address',
                'delivered_at'
            ]);
        });
    }
};
