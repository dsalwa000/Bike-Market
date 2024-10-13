<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// The name of the class should mathch to the file's name.
class Check extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        // Create table for storing roles
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create table for storing permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create table for associating roles to users and teams (Many To Many Polymorphic)
        Schema::create('role_user', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('user_id');
            $table->string('user_type');

            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'role_id', 'user_type']);
        });

        // Create table for associating permissions to users (Many To Many Polymorphic)
        Schema::create('permission_user', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('user_id');
            $table->string('user_type');

            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'permission_id', 'user_type']);
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('permission_role', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id');

            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });


        // FOR BIKE
        Schema::create('producents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('value');
            $table->timestamps();
        });

        Schema::create('localisations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('value');
            $table->timestamps();
        });

        Schema::create('conditions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('value');
            $table->timestamps();
        });

        Schema::create('purposes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('value');
            $table->timestamps();
        });

        Schema::create('bikes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('producent');
            $table->foreign('producent')->references('id')
                ->on('producents');

            $table->unsignedBigInteger('localisation');
            $table->foreign('localisation')->references('id')
                ->on('localisations');

            $table->unsignedBigInteger('conditions');
            $table->foreign('conditions')->references('id')
                ->on('conditions');

            $table->unsignedBigInteger('purposes');
            $table->foreign('purposes')->references('id')
                ->on('purposes');

            $table->string('name');
            $table->string('description');
            $table->string('dimentions');
            $table->string('phone');
            $table->unsignedBigInteger('year');
            $table->unsignedBigInteger('price');
            $table->string('pdf-s');

            $table->timestamps();
        });

        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bike');
            $table->foreign('bike')->references('id')
                ->on('bikes');
            $table->string('image');
            $table->timestamps();
        });

        Schema::create('inquiryGenerals', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('nameAndSurname');
            $table->string('email');
            $table->string('nameOfTheCompany');
            $table->string('message');

            $table->timestamps();
        });

        Schema::create('inquiryBikes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('nameAndSurname');
            $table->string('email');
            $table->string('nameOfTheCompany');
            $table->string('message');

            $table->unsignedBigInteger('bike');
            $table->foreign('bike')->references('id')
                ->on('bikes');

            $table->timestamps();
        });

        Schema::create('formBikebuys', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('nameAndSurname');
            $table->string('email');
            $table->string('nameOfTheCompany');
            $table->string('message');

            $table->timestamps();
        });

        Schema::create('formPictures', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('images');

            $table->unsignedBigInteger('form');
            $table->foreign('form')->references('id')
                ->on('formBikebuys');

            $table->timestamps();
        });

        Schema::create('formToFiles', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('formularz');

            $table->unsignedBigInteger('formularz_id');
            $table->foreign('formularz_id')->references('id')
                ->on('formBikebuys');

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
        Schema::dropIfExists('users');

        Schema::dropIfExists('password_resets');

        Schema::dropIfExists('failed_jobs');

        Schema::dropIfExists('permission_user');
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('roles');

        Schema::dropIfExists('producents');

        Schema::dropIfExists('localisations');

        Schema::dropIfExists('conditions');

        Schema::dropIfExists('purposes');

        Schema::dropIfExists('bikes');

        Schema::dropIfExists('images');

        Schema::dropIfExists('inquiryGeneral');

        Schema::dropIfExists('inquiryBike');

        Schema::dropIfExists('formBikebuy');

        Schema::dropIfExists('formPictures');

        Schema::dropIfExists('formToFile');
    }
}
