<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialCategoryAssociationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_category_associations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('material_id');
            $table->foreignId('category_id');

            // constraints
            $table->foreign('material_id')->references('id')->on('materials');
            $table->foreign('category_id')->references('id')->on('categories');

            $table->unique(['material_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_category_associations');
    }
}
