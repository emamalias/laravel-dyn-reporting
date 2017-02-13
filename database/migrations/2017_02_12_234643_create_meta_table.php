<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta', function (Blueprint $table) {
            $table->increments('id');
            $table->string('object_type'); //model relationship like user, website, reports, etc
            $table->integer('object_id'); //relationship_id eg: user_id, website_id, reports_ed
            $table->string('name'); //name of the column like first_name, last_name, etc.
            $table->string('label'); //camel case of the column like first_name => First Name
            $table->string('type')->default('text');
            $table->text('value');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meta');
    }
}
