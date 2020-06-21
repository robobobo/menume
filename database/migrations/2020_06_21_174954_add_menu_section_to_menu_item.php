<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMenuSectionToMenuItem extends Migration
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
            $table->unsignedBigInteger('menu_section_id')->nullable();
            $table->foreign('menu_section_id')->references('id')->on('menu_sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menuitems', function (Blueprint $table) {
            //
            $table->dropColumn('menu_section_id');
        });
    }
}
