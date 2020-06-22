<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderingToMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu_items', function (Blueprint $table) {
            //
            $table->integer('position')->nullable();
        });

        Schema::table('menu_sections', function (Blueprint $table) {
            //
            $table->integer('position')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_items', function (Blueprint $table) {
            //
            $table->dropColumn('position');
        });

        Schema::table('menu_sections', function (Blueprint $table) {
            //
            $table->dropColumn('position');
        });
    }
}
