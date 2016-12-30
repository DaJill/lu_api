<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserinfoTable extends Migration
{
    protected $connection = 'Core';
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UserInfo', function (Blueprint $table) {
            $table->bigIncrements('UserID')->comment('會員編號');
            $table->string('Nickname', 100)->default('')->comment('會員暱稱');
            $table->string('UserName', 20)->comment('會員帳號');
            $table->string('Password', 20)->comment('會員密碼');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('UserInfo');
    }
}
