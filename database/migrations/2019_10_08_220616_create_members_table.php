<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
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
            $table->string('sex',15)->nullable();
            $table->boolean('active');
            $table->string('first_name', 65)->nullable(false);
            $table->string('last_name', 65)->nullable(false);
            $table->string('address', 65)->nullable(false);
            $table->string('zip', 31)->nullable(false);;
            $table->string('city', 65)->nullable(false);
            $table->string('email', 65)->nullable();
            $table->string('phone_home', 65)->nullable();
            $table->string('phone_mobile', 65)->nullable();
            $table->string('phone_office', 65)->nullable();
            $table->date('birthday')->nullable();
            $table->date('member_since')->nullable();
            $table->date('member_until')->nullable();
            $table->boolean('license')->nullable();
            $table->boolean('newsletter')->nullable();
            $table->string('comment', 255)->nullable();
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
