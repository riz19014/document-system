<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDmAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dm_audits', function (Blueprint $table) {
            $table->id();
            $table->timestamp("date")->nullable();
            $table->string('user')->nullable();
            $table->string('object_type')->nullable();
            $table->string('object_id')->nullable();
            $table->string('object')->nullable();
            $table->longText('action')->nullable();
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
        Schema::dropIfExists('dm_audits');
    }
}
