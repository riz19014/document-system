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
            $table->string('file_mime')->nullable();
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
            $table->string('note')->nullable();
            $table->tinyInteger('file_locked')->default(0);
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
        Schema::dropIfExists('dm_file_uploads');
    }
}
