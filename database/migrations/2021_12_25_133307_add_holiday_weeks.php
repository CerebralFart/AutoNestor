<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHolidayWeeks extends Migration {
    public function up() {
        Schema::table('weeks', function (Blueprint $table) {
            $table->boolean('is_holiday')->default(false);
        });
    }

    public function down() {
        Schema::table('weeks', function (Blueprint $table) {
            $table->dropColumn('is_holiday');
        });
    }
}
