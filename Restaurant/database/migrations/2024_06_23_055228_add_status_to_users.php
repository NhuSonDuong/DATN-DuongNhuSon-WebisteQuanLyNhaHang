<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //migrate sẽ gọi up tượng chưng cho khi ấn trạng thái hoạt động
    public function up()
    {
        //thêm cột status sau cột role
        Schema::table('users', function (Blueprint $table) {
            $table->integer('status')->after('role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    //rollback cột status// khi migrate:rollback thì sẽ gọi function down
    public function down()
    {
        // xóa cột status
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
