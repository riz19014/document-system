<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDmNumberingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dm_numberings', function (Blueprint $table) {
             $table->id(); // Primary key
             $table->unsignedBigInteger('entity_id');
             $table->tinyInteger('entity_type'); 
             $table->string('numbering', 50)->nullable();
             $table->bigInteger('company_id')->nullable();
             $table->bigInteger('company_branch_id')->nullable();
             $table->bigInteger('department_id')->nullable();
             $table->bigInteger('section_id')->nullable();
             $table->timestamps();

             // Add index for better performance
             $table->index(['entity_id', 'entity_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dm_numberings');
    }
}
