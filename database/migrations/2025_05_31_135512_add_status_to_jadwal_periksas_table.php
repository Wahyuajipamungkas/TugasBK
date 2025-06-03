<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToJadwalPeriksasTable extends Migration
{
    public function up(): void
    {
        Schema::table('jadwal_periksas', function (Blueprint $table) {
            $table->tinyInteger('status')->default(1)->after('jam_selesai');
        });
    }

    public function down(): void
    {
        Schema::table('jadwal_periksas', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
