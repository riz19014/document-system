<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDmSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dm_sections', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->unsignedInteger('parent_id')->nullable();
            $table->tinyInteger('object_type')->default(1);
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
        Schema::dropIfExists('dm_sections');
    }
}
