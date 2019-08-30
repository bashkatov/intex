<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('marker_has_types', function (Blueprint $table) {
            $table
                ->integer('marker_id')
                ->unsigned()
                ->foreign('marker_id')
                ->references('id')
                ->on('markers')
                ->onDelete('cascade')
                ->index();

            $table
                ->integer('type_id')
                ->unsigned()
                ->foreign('type_id')
                ->references('id')
                ->on('types')
                ->onDelete('cascade')
                ->index();

            $table->primary(['marker_id', 'type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marker_has_types');
        Schema::dropIfExists('types');
    }
}
