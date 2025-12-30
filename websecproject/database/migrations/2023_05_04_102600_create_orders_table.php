<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('delivery_status', [
                'pending',      
                'processing',
                'packaging',
                'shipped',
                'on_the_way',
                'delivered',
                'passive_order'   
            ])->default('pending')->change();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('delivery_status', [
                'processing',
                'packaging',
                'shipped',
                'on_the_way',
                'delivered'
            ])->nullable()->default(null)->change();
        });
    }
};
