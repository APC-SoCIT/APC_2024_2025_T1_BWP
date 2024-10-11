<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('title'); // Book title
            $table->string('author'); // Author of the book
            $table->text('description'); // Description of the book
            $table->integer('rating')->unsigned(); // Rating (1-5)
            $table->date('publish_date'); // Date of publication
            $table->string('isbn'); // ISBN of the book (required)
            $table->string('file')->nullable(); // Path to uploaded file (optional)
            $table->string('cover_image')->nullable();
            $table->enum('visibility', ['public', 'members_only'])->default('public'); // Visibility field
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
