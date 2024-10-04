<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('category_id');
            $table->string('name');
            $table->timestamp('last_update')->useCurrent();
        });
    }


    public function down()
    {
        Schema::dropIfExists('category');
    }
}
