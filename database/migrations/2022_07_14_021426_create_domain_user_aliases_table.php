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
        Schema::create('domain_user_aliases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('source_id')->constrained('domain_users', 'id');
            $table->string('destination', 170);
            $table->unique(['source_id']);
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
        Schema::dropIfExists('domain_user_aliases');
    }
};
