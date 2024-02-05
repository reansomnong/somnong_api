<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\API\Admin\gb_pos_exchange;
class ExchangeSeender extends Seeder
{
    public function run(): void
    {
        //
        $ex = new gb_pos_exchange();
        $ex->currency_code = '01';
        $ex->currency = 'USD';
        $ex->symbol = '$';
        $ex->active = '1';
        $ex->save();

        $ex = new gb_pos_exchange();
        $ex->currency_code = '02';
        $ex->currency = 'KHR';
        $ex->symbol = '៛';
        $ex->active = '1';
        $ex->save();

        $ex = new gb_pos_exchange();
        $ex->currency_code = '03';
        $ex->currency = 'CNY';
        $ex->symbol = '¥';
        $ex->active = '1';
        $ex->save();

    }
}
