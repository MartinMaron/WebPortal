<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fileContent = Storage::disk('local')->get('ii_us.json');
        $users = json_decode($fileContent);
        foreach ( $users as $key => $value) {
            User::create([
                "name" => $value->name,
                "email" => $value->email,
                "password" => $value->password,
                "current_team_id" => $value->current_team_id,
                "isAdmin" => 1,
                "isMieter" => 1,
                "isUser" => 1,
            ]);
        };
    }
}
