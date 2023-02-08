<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDmMetaTaggingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dm_meta_taggings', function (Blueprint $table) {
            $table->id();
            $table->string('tagging_name');
            $table->bigInteger('company_id')->nullable();
            $table->bigInteger('company_branch_id')->nullable();
            $table->bigInteger('department_id')->nullable();
            $table->bigInteger('section_id')->nullable();
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
        Schema::dropIfExists('dm_meta_taggings');
    }
}
