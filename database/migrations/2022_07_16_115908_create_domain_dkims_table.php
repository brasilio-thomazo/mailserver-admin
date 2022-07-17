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
        Schema::create('domain_dkims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('domain_id')->constrained('domains', 'id');
            $table->string('selector', 15)->unique();
            $table->enum('key_bits', [1024, 2048])->default(2048);
            $table->enum('algorithm', ['sha1', 'sha256', 'sha512'])->default('sha256');
            $table->enum('key_type', ['dh', 'ec', 'dsa', 'rsa'])->default('rsa');
            $table->text('private_key');
            $table->text('public_key');
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
        Schema::dropIfExists('domain_dkims');
    }
};
