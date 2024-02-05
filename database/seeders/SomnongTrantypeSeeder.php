<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\API\Somnong\somnong_trantype;

class SomnongTrantypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $trantype = new somnong_trantype();
        $trantype->tran_code='01';
        $trantype->description='Cost';
        $trantype->active='1';
        $trantype->value='1';
        $trantype->inputter='IT.SYSTEM';
        $trantype->save();


        $trantype = new somnong_trantype();
        $trantype->tran_code='02';
        $trantype->description='First Payment';
        $trantype->active='1';
        $trantype->value='1';
        $trantype->inputter='IT.SYSTEM';
        $trantype->save();

        $trantype = new somnong_trantype();
        $trantype->tran_code='03';
        $trantype->description='Services charge';
        $trantype->active='1';
        $trantype->value='1';
        $trantype->inputter='IT.SYSTEM';
        $trantype->save();


        $trantype = new somnong_trantype();
        $trantype->tran_code='04';
        $trantype->description='Staff Exp';
        $trantype->active='1';
        $trantype->value='-1';
        $trantype->inputter='IT.SYSTEM';
        $trantype->save();


        $trantype = new somnong_trantype();
        $trantype->tran_code='05';
        $trantype->description='Labour Exp';
        $trantype->active='1';
        $trantype->value='-1';
        $trantype->inputter='IT.SYSTEM';
        $trantype->save();

        $trantype = new somnong_trantype();
        $trantype->tran_code='06';
        $trantype->description='Service Exp';
        $trantype->active='1';
        $trantype->value='-1';
        $trantype->inputter='IT.SYSTEM';
        $trantype->save();


        $trantype = new somnong_trantype();
        $trantype->tran_code='07';
        $trantype->description='Other Exp';
        $trantype->active='1';
        $trantype->value='-1';
        $trantype->inputter='IT.SYSTEM';
        $trantype->save();

    }
}
