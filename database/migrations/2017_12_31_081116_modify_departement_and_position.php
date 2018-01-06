<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyDepartementAndPosition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(['department', 'position']);
            $table->integer('department_id')->unsigned()->nullable();
            $table->integer('position_id')->unsigned()->nullable();

            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null')->onUpdate('set null');
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('set null')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropForeign(['position_id']);
            $table->dropColumn(['department_id', 'position_id']);
        });
    }
}
