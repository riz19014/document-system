<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovalStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approval_statuses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('serial_id')->nullable();
            $table->tinyInteger('notify')->default(0);
            $table->bigInteger('file_id')->nullable();
            $table->timestamp("approval_date")->nullable();
            $table->tinyInteger("approval_status")->default(1);
            $table->string('resolution')->nullable();
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
        Schema::dropIfExists('approval_statuses');
    }
}
