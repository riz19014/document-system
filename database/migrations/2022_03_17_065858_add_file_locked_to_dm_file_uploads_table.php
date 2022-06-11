<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileLockedToDmFileUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dm_file_uploads', function (Blueprint $table) {
             $table->tinyInteger('file_locked')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dm_file_uploads', function (Blueprint $table) {
            $table->dropColumn('file_locked');
        });
    }
}
