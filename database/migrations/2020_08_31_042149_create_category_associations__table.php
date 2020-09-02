<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryAssociationsTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('category_associations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('child_category_id');
            $table->foreignId('parent_category_id');

            $table->foreign('child_category_id')->references('id')->on('categories');
            $table->foreign('parent_category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_associations');
    }
}
