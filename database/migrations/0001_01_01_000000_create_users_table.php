<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('avatar')->nullable();
            $table->string('email')->unique();
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });


        //creating users
        $user = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
        $user->profile()->create();

        // creating users
        $user = User::create([
            'first_name' => 'user1',
            'last_name' => 'user1',
            'email' => 'user1@user.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => now(),
        ]);
        $user->profile()->create();

        $user = User::create([
            'first_name' => 'user2',
            'last_name' => 'user2',
            'email' => 'user2@user.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => now(),
        ]);
        $user->profile()->create();

        $user = User::create([
            'first_name' => 'user3',
            'last_name' => 'user3',
            'email' => 'user3@user.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => now(),
        ]);
        $user->profile()->create();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
