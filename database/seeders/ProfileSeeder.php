<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\API\Profiles\Profile;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $profile = new Profile();
        $profile->profile = 'Admin System';
        $profile->system_id = '1';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Manager & Controller';
        $profile->system_id = '1';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Accountant';
        $profile->system_id = '1';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Stock';
        $profile->system_id = '1';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Sale';
        $profile->system_id = '1';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Audit';
        $profile->system_id = '1';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Reporter';
        $profile->system_id = '1';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Manager & Controller';
        $profile->system_id = '2';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Accountant';
        $profile->system_id = '2';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Stock';
        $profile->system_id = '2';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Sale';
        $profile->system_id = '2';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Audit';
        $profile->system_id = '2';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Reporter';
        $profile->system_id = '2';
        $profile->active = '1';
        $profile->save();
        
        $profile = new Profile();
        $profile->profile = 'Manager & Controller';
        $profile->system_id = '3';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Accountant';
        $profile->system_id = '3';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Stock';
        $profile->system_id = '3';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Sale';
        $profile->system_id = '3';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Audit';
        $profile->system_id = '3';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Reporter';
        $profile->system_id = '3';
        $profile->active = '1';
        $profile->save();


        $profile = new Profile();
        $profile->profile = 'Manager & Controller';
        $profile->system_id = '4';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Accountant';
        $profile->system_id = '4';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Stock';
        $profile->system_id = '4';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Sale';
        $profile->system_id = '4';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Audit';
        $profile->system_id = '4';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Reporter';
        $profile->system_id = '4';
        $profile->active = '1';
        $profile->save();


        $profile = new Profile();
        $profile->profile = 'Manager & Controller';
        $profile->system_id = '5';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Accountant';
        $profile->system_id = '5';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Stock';
        $profile->system_id = '5';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Sale';
        $profile->system_id = '5';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Audit';
        $profile->system_id = '5';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Reporter';
        $profile->system_id = '5';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Supervisor';
        $profile->system_id = '6';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Supervisor & Controller';
        $profile->system_id = '6';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'MEP Engineering';
        $profile->system_id = '6';
        $profile->active = '1';
        $profile->save();

        $profile = new Profile();
        $profile->profile = 'Architecture';
        $profile->system_id = '6';
        $profile->active = '1';
        $profile->save();
    }
}
