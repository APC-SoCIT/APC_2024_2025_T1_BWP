<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

  public function up(): void{Schema::create('users', function (Blueprint $table) {
$table->id();
$table->string('username')->unique(); // Ensure unique usernames
$table->string('password');
$table->enum('account_type', ['member', 'admin']); // Add account type
$table->rememberToken();
$table->timestamps();

});

}

  public function down(): void{Schema::dropIfExists('users');}
};
