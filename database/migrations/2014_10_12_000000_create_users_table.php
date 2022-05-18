<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('estado')->default(1);
            $table->tinyInteger('tipo')->default(1);
            $table->tinyInteger('situacion')->default(1);
            $table->bigInteger('company_id')->default(1);
            $table->bigInteger('extension_id')->default(0);
            $table->bigInteger('extension')->default(0);
            $table->bigInteger('trunk_id')->default(0);
            $table->string('trunk_name')->nullable();
            $table->string('trunk_did')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('color')->default('#FFFF00');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });
        DB::table('users')->insert([
            [
                'name' => 'Victor Antonio Candela Buendia',
                'email' => 'victorcandela@gmail.com',
                'company_id' => '5000',
                'password' => Hash::make('10637052'),
                'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
