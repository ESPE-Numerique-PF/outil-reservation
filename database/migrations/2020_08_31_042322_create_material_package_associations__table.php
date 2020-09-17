<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialPackageAssociationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_package_associations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('material_id');
            $table->foreignId('package_id');

            // constraints
            $table->foreign('material_id')->references('id')->on('materials');
            $table->foreign('package_id')->references('id')->on('packages');

            $table->unique(['material_id', 'package_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_package_associations');
    }
}
