<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\CommunityLink;
use App\Models\User;
use App\Models\Channel;
use App\Models\Writer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::delete('delete from community_links');
        DB::delete('delete from channels');
        DB::delete('delete from users');
        DB::delete('delete from writers');

        Writer::factory()->count(3)->create();
        User::factory()->count(5)->create();
        Channel::factory()->count(3)->create();
        CommunityLink::factory()->count(15)->create();

    }
}
