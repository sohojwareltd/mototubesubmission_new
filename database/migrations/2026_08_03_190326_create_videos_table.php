<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('video');
            $table->string('video_url')->nullable();
            $table->text('description');
            $table->string('city', 30);
            $table->string('state', 30);
            $table->string('country', 30);
            $table->string('when_filmed', 30)->nullable();
            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->string('email', 100);
            $table->string('birthdate', 100)->nullable();
            $table->string('phone', 200)->nullable();
            $table->string('person_who_filmed', 200);
            $table->string('person_who_filmed_other', 200)->nullable();
            $table->string('submit_other_website', 200);
            $table->string('submit_place', 200)->nullable();
            $table->string('did_anyone_reach', 200);
            $table->string('share_reach_name', 200)->nullable();
            $table->string('aggrement_with_another_company', 200);
            $table->string('video_credit', 200)->nullable();
            $table->string('people_appearing', 200);
            $table->string('people_appearing_list', 200)->nullable();
            $table->string('signature')->nullable();
            $table->string('user_ip')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
