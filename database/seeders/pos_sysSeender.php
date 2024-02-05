<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\API\POS\pos_sys;
class pos_sysSeender extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $pos_sys = new pos_sys();
        $pos_sys->con_name = 'pro_line';
        $pos_sys->con_value = '01';
        $pos_sys->con_title = 'Category';
        $pos_sys->active = '1';
        $pos_sys->save();

        $pos_sys = new pos_sys();
        $pos_sys->con_name = 'pro_line';
        $pos_sys->con_value = '02';
        $pos_sys->con_title = 'Line';
        $pos_sys->active = '1';
        $pos_sys->save();

        $pos_sys = new pos_sys();
        $pos_sys->con_name = 'pro_line';
        $pos_sys->con_value = '03';
        $pos_sys->con_title = 'Color';
        $pos_sys->active = '1';
        $pos_sys->save();

        $pos_sys = new pos_sys();
        $pos_sys->con_name = 'pro_line';
        $pos_sys->con_value = '04';
        $pos_sys->con_title = 'Year';
        $pos_sys->active = '1';
        $pos_sys->save();

        $pos_sys = new pos_sys();
        $pos_sys->con_name = 'pro_line';
        $pos_sys->con_value = '05';
        $pos_sys->con_title = 'Size';
        $pos_sys->active = '1';
        $pos_sys->save();

    }
}
