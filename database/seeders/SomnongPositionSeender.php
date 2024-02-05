<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\API\Somnong\somnong_position;
class SomnongPositionSeender extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $db_add = new somnong_position();
        $db_add->position_id='01';
        $db_add->title='BM';
        $db_add->active='1';
        $db_add->inputter='IT.SYSTEM';
        $db_add->save();


        $db_add = new somnong_position();
        $db_add->position_id='02';
        $db_add->title='Manager';
        $db_add->active='1';
        $db_add->inputter='IT.SYSTEM';
        $db_add->save();

        $db_add = new somnong_position();
        $db_add->position_id='03';
        $db_add->title='Supervisor';
        $db_add->active='1';
        $db_add->inputter='IT.SYSTEM';
        $db_add->save();

        $db_add = new somnong_position();
        $db_add->position_id='04';
        $db_add->title='Sit Supervisor';
        $db_add->active='1';
        $db_add->inputter='IT.SYSTEM';
        $db_add->save();

        $db_add = new somnong_position();
        $db_add->position_id='05';
        $db_add->title='MEP';
        $db_add->active='1';
        $db_add->inputter='IT.SYSTEM';
        $db_add->save();

        $db_add = new somnong_position();
        $db_add->position_id='06';
        $db_add->title='Architecture';
        $db_add->active='1';
        $db_add->inputter='IT.SYSTEM';
        $db_add->save();

    }
}
