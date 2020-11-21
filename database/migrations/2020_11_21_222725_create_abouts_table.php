<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->string('title')->default('')->comment('标题');
            $table->mediumText('markdown')->nullable()->comment('markdown文章内容');
            $table->mediumText('html')->nullable()->comment('markdown转的html页面');
            $table->unsignedInteger('order')->unsigned()->default(0)->comment('排序');
            $table->unsignedTinyInteger('is_enable')->default(0)->comment('是否开启');
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
        Schema::dropIfExists('abouts');
    }
}
