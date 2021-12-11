<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaskSupervision extends Migration {
    public function up() {
        Schema::table('tasks', function (Blueprint $table) {
            $table->boolean('is_supervision')->default(false);
        });
    }

    public function down() {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('is_supervision');
        });
    }
}
