<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();   
            $table->bigInteger('role_id')->nullable();      
            $table->string('country')->nullable();
            $table->string('industry')->nullable();
            $table->tinyInteger('term_condition')->default(0);
            $table->tinyInteger('privacy')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->bigInteger('company_id')->nullable();
            $table->bigInteger('company_branch_id')->nullable();
            $table->bigInteger('department_id')->nullable();
            $table->bigInteger('section_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
