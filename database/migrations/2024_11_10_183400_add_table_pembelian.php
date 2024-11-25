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
        Schema::table('pembelians', function (Blueprint $table) {
            $table->string('invoice_number')->after('id');
            $table->enum('status', ['Proses', 'Menunggu Verifikasi', 'Sukses'])->after('total_pembayaran');
            $table->string('bukti_tf')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembelians', function (Blueprint $table) {
            $table->dropColumn('invoice_number');
            $table->dropColumn('status');
            $table->dropColumn('bukti_tf');
        });
    }
};
