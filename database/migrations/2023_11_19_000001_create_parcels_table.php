<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('parcels', function (Blueprint $table) {
            $table->id();
            $table->string('parcel_number');
            $table->string('agent_name');
            $table->string('agent_phone');
            $table->string('agent_id_number');
            $table->string('branch_name');
            $table->string('serial_number')->unique();
            $table->enum('status', ['pending', 'delivered'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('parcels');
    }
};
