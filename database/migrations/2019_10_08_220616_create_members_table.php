<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sex');
            $table->boolean('active');
            $table->string('first_name', 65)->nullable(false);
            $table->string('last_name', 65)->nullable(false);
            $table->string('address', 65)->nullable(false);
            $table->integer('zip');
            $table->string('city', 65)->nullable(false);
            $table->string('email', 255)->nullable();
            $table->string('phone', 65)->nullable();
            $table->date('birthday');
            $table->date('member_since');
            $table->date('member_until');
            $table->unsignedBigInteger('membership_id')->nullable();
            $table->foreign('membership_id')->references('id')->on('memberships')
                ->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
