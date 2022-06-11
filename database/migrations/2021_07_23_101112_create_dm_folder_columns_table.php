<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDmFolderColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dm_folder_columns', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('folder_id')->nullable();
            $table->bigInteger('meta_tag_id')->nullable();
            $table->bigInteger('tab_index')->nullable();
            $table->tinyInteger('tag_value')->default(0);
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
        Schema::dropIfExists('dm_folder_columns');
    }
}
