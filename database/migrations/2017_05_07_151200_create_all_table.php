<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 100)->unique();
        });

        Schema::create('positions', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 100)->unique();
        });

        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('nin')->unique();
            $table->string('ein')->unique();
            $table->string('name');
            $table->enum('gender', [0, 1]);
            $table->string('born_in');
            $table->date('birthdate');
            $table->string('city');
            $table->tinyInteger('marital_status');
            $table->string('last_education');
            $table->text('address');
            $table->string('photo');
            $table->date('joined_at');
            $table->integer('department')->unsigned();
            $table->integer('position')->unsigned();

            $table->foreign('department')->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('position')->references('id')->on('positions')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('salary_rules', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->double('basic_salary');
            $table->double('allowance');
            $table->double('eat_cost');
            $table->double('transportation');
            $table->integer('employee')->unsigned();
            $table->enum('status', [0, 1]);

            $table->foreign('employee')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('username', 100)->unique();
            $table->string('password');
            $table->string('avatar_path');
            $table->rememberToken();
            $table->enum('level', [0, 1, 2])->default(1);
            $table->integer('employee')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('employee')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->date('created_at');
            $table->enum('status', [0, 1, 2]);
            $table->time('enter_at')->nullable();
            $table->time('out_at')->nullable();
            $table->string('information');
            $table->integer('employee')->unsigned();

            $table->foreign('employee')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('over_times', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->date('created_at');
            $table->double('pay');
            $table->text('information');
            $table->integer('employee')->unsigned();

            $table->foreign('employee')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->date('created_at');
            $table->double('total');
            $table->enum('status', [0, 1]);
            $table->text('information');
            $table->integer('employee')->unsigned();

            $table->foreign('employee')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('salaries', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->date('created_at');
            $table->tinyInteger('month');
            $table->tinyInteger('year');
            $table->double('over_time_total');
            $table->double('loan');
            $table->double('thr');
            $table->double('reward');
            $table->double('punishment');
            $table->integer('salary_rule')->unsigned();
            $table->integer('employee')->unsigned();

            $table->foreign('employee')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('salary_rule')->references('id')->on('salary_rules')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('company', function(Blueprint $table){
            $table->increments('id')->unsigned();
            $table->string('name', 100)->unique();
            $table->string('contact', 100);
            $table->text('address');
            $table->string('logo_export', 100);
        });

        Schema::create('system_activities', function(Blueprint $table){
            $table->increments('id')->unsigned();
            $table->string('event');
            $table->timestamp('created_at');
            $table->integer('user')->unsigned();

            $table->foreign('user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('authorities', function(Blueprint $table){
            $table->increments('id')->unsigned();
            $table->integer('user')->unsigned();
            $modules = ['accounts', 'attendances', 'over_time', 'loans', 'salaries', 'employees', 'departments', 'positions', 'company_profile', 'salary_rules'];
            foreach ($modules as $m) {
                $table->enum($m, [0,1]);
            }

            $table->foreign('user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('admin_bio', function(Blueprint $table){
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->enum('gender', [0, 1]);
            $table->string('born_in');
            $table->date('birthdate');
            $table->text('address');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function(Blueprint $table){
            $table->dropForeign(['department']);
            $table->dropForeign(['position']);
        });

        Schema::table('attendances', function(Blueprint $table){
            $table->dropForeign(['employee']);
        });

        Schema::table('loans', function(Blueprint $table){
            $table->dropForeign(['employee']);
        });

        Schema::table('users', function(Blueprint $table){
            $table->dropForeign(['employee']);
        });

        Schema::table('over_times', function(Blueprint $table){
            $table->dropForeign(['employee']);
        });

        Schema::table('authorities', function(Blueprint $table){
            $table->dropForeign(['user']);
        });

        Schema::table('system_activities', function(Blueprint $table){
            $table->dropForeign(['user']);
        });

        Schema::table('salaries', function(Blueprint $table){
            $table->dropForeign(['employee']);
            $table->dropForeign(['salary_rule']);
        });

        $tables = ['users', 'attendances', 'over_times', 'loans', 'salaries', 'employees', 'salary_rules', 'departments', 'positions', 'company', 'admin_bio', 'authorities', 'system_activities'];
        foreach ($tables as $t) {
            Schema::dropIfExists($t);
        }

    }
}

