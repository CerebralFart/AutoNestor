<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeUsersOrderable extends Migration {
    public function up() {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('order')->default(0)->after('id');
        });
    }

    public function down() {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
}
