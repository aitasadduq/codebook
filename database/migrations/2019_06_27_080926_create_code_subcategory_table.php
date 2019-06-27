<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeSubcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_subcategory', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('subcategory_id');
            $table->unsignedInteger('code_id');
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
        Schema::dropIfExists('code_subcategory');
    }
}
