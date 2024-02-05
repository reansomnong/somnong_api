<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\API\POS\pos_sys;
use App\Models\API\Profiles\Profile;
use Illuminate\Database\Seeder;
use Database\Seeders\SystemSeeder;
use Database\Seeders\BranchSeeder;
use Database\Seeders\MenuSeeder;
use Database\Seeders\ProvincesTableSeeder;
use Database\Seeders\ProfileSeeder;
use Database\Seeders\SyscontantsSeeder;
use Database\Seeders\posProductlineSeeder;
use Database\Seeders\ExchangeSeender;
use Database\Seeders\pos_sysSeender;
use Database\Seeders\SomnongTrantypeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(1)->create();

         \App\Models\User::factory()->create([
            'branch_code' => '0001',
            'name' => 'joincoder',
            'email' => 'joincoder@gmail.com',
            'profile_id' => '1',
            'active' => '1',
            'password'=>'$2y$10$BOF5oU6EKbnIAmJqK5Jq5OPTgehifz8MHq5SfT2AZhP/zpzitMptm',
            'inputter' => 'IT.SYSTEM'
         ]);

         $this->call(SystemSeeder::class);
         $this->call(BranchSeeder::class);
         $this->call(MenuSeeder::class);
         $this->call(ProvincesTableSeeder::class);
         $this->call(ProfileSeeder::class);
         $this->call(SyscontantsSeeder::class);
         $this->call(ExchangeSeender::class);
         $this->call(pos_sysSeender::class);
         $this->call(SomnongTrantypeSeeder::class);
         $this->call(SomnongPositionSeender::class);
    }
}
