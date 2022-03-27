<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("publisher_id")->index();
            $table->unsignedBigInteger("country_id")->index();
            $table->string("name");
            $table->unsignedBigInteger("resource_id");
            $table->string("media_type");
            $table->string("isbn", 20);
            $table->integer("number_of_pages");
            $table->timestamp("released_date");
            $table->softDeletes();
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
        Schema::dropIfExists('books');
    }
}
