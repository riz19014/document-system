<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDmFileUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dm_file_uploads', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('folder_id')->nullable();
            $table->string('doc_name')->nullable();
            $table->tinyInteger('notify')->default(0);
            $table->string('tags')->nullable();
            $table->string('file_size')->nullable();
            $table->tinyInteger('is_delete')->default(0);
            $table->timestamp("deleted_at")->nullable();
            $table->timestamp("date")->nullable();
            $table->timestamp("due_date")->nullable();
             $table->string('signature')->nullable();
            $table->tinyInteger('object_type')->default(2);
            $table->string('doc_path')->nullable();
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
        Schema::dropIfExists('dm_file_uploads');
    }
}
