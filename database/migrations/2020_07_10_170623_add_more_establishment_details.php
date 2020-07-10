<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreEstablishmentDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('establishments', function (Blueprint $table) {
            //
            $table->text('contact_person')->nullable();
            $table->text('email_address')->nullable();
            $table->text('contact_number')->nullable();
            $table->text('address_1')->nullable();
            $table->text('address_2')->nullable();
            $table->text('town_city')->nullable();
            $table->text('postcode')->nullable();
            $table->text('county')->nullable();
            $table->text('country')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('establishments', function (Blueprint $table) {
            //
            $table->dropColumn('contact_person');
            $table->dropColumn('email_address');
            $table->dropColumn('contact_number');
            $table->dropColumn('address_1');
            $table->dropColumn('address_2');
            $table->dropColumn('town_city');
            $table->dropColumn('postcode');
            $table->dropColumn('county');
            $table->dropColumn('country');
        });
    }
}
