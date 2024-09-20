<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('researches', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->date('publish_date');
            $table->string('doi');
            $table->text('abstract');
            $table->string('keywords');
            $table->string('file_path');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('visibility', ['public', 'members_only'])->default('public');
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
        Schema::dropIfExists('researches');
    }
}
