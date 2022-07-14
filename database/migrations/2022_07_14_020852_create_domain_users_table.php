<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domain_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('domain_id')->constrained('domains', 'id');
            $table->string('user', 50);
            $table->string('password');
            $table->unique(['user', 'domain_id']);
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
        Schema::dropIfExists('domain_users');
    }
};
