<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDmFileTaggingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dm_file_taggings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('file_scan_id')->nullable();
            $table->bigInteger('folder_id')->nullable();
            $table->string('meta_tag_id')->nullable();
            $table->string('meta_tag_value')->nullable();
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
        Schema::dropIfExists('dm_file_taggings');
    }
}
