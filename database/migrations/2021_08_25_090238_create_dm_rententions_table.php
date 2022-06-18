<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDmRententionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dm_rententions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('file_id')->nullable();
            $table->string('count_value')->nullable();
            $table->string('description')->nullable();
            $table->timestamp("end_date")->nullable();
            $table->tinyInteger('company_id')->nullable();
            $table->tinyInteger('company_branch_id')->nullable();
            $table->tinyInteger('department_id')->nullable();
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
        Schema::dropIfExists('dm_rententions');
    }
}
