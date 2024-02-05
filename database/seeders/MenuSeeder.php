<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $menu = new Menu();
        $menu->icon = 'Home';
        $menu->pagename = 'side-menu-dashboard';
        $menu->title = 'Dashboard';
        $menu->parent_id = null;
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '1';
        $menu->save();

        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-dashboard-overview-1';
        $menu->title = 'Overview 1';
        $menu->parent_id = '1';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '2';
        $menu->save();

        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-dashboard-overview-2';
        $menu->title = 'Overview 2';
        $menu->parent_id = '1';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '3';
        $menu->save();

        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-dashboard-overview-3';
        $menu->title = 'Overview 3';
        $menu->parent_id = '1';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '4';
        $menu->save();

        $menu = new Menu();
        $menu->icon = 'ShoppingBag';
        $menu->pagename = 'side-menu-ecommerce';
        $menu->title = 'E-Commerce';
        $menu->parent_id = null;
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '5';
        $menu->save();

        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-categories';
        $menu->title = 'Categories';
        $menu->parent_id = '5';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '6';
        $menu->save();


        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-add-product';
        $menu->title = 'Register Product';
        $menu->parent_id = '5';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '7';
        $menu->save();

        $menu = new Menu();
        $menu->icon = 'Settings';
        $menu->pagename = 'side-menu-setting';
        $menu->title = 'Settings';
        $menu->parent_id = null;
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '8';
        $menu->save();

        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-add-branch';
        $menu->title = 'Register Branch';
        $menu->parent_id = '8';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '9';
        $menu->save();

        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-add-user';
        $menu->title = 'Register User';
        $menu->parent_id = '8';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '10';
        $menu->save();

        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-add-menu';
        $menu->title = 'Register Menu';
        $menu->parent_id = '8';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '11';
        $menu->save();



        $menu = new Menu();
        $menu->icon = 'Layers';
        $menu->pagename = 'side-menu-pos';
        $menu->title = 'POS Inventory';
        $menu->parent_id = null;
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '12';
        $menu->save();

        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-pos-stock';
        $menu->title = 'Register Stock';
        $menu->parent_id = '12';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '13';
        $menu->save();

        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-pos-product';
        $menu->title = 'Register Product';
        $menu->parent_id = '12';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '14';
        $menu->save();


        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-pos-customer';
        $menu->title = 'Register Customer';
        $menu->parent_id = '12';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '15';
        $menu->save();


        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-pos-supply';
        $menu->title = 'Register Supply';
        $menu->parent_id = '12';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '16';
        $menu->save();

        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-pos-purchaseorder';
        $menu->title = 'Purchase Order';
        $menu->parent_id = '12';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '17';
        $menu->save();


        $menu = new Menu();
        $menu->icon = 'Layers';
        $menu->pagename = 'side-menu-pos';
        $menu->title = 'POS Authorize';
        $menu->parent_id = null;
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '18';
        $menu->save();



        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-pos-auth_po';
        $menu->title = 'Purchase Order';
        $menu->parent_id = '18';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '19';
        $menu->save();


        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-pos-auth_pos';
        $menu->title = 'POS';
        $menu->parent_id = '18';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '20';
        $menu->save();

        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-pos-auth_transfer';
        $menu->title = 'Stock Transfer';
        $menu->parent_id = '18';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '21';
        $menu->save();


        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-pos-auth-count';
        $menu->title = 'Count Stock';
        $menu->parent_id = '18';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '22';
        $menu->save();


        $menu = new Menu();
        $menu->icon = 'Layers';
        $menu->pagename = 'side-menu-pos';
        $menu->title = 'Point Of Sale';
        $menu->parent_id = null;
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '23';
        $menu->save();

        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-point-sale';
        $menu->title = 'POS';
        $menu->parent_id = '23';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '24';
        $menu->save();

        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-pos-category';
        $menu->title = 'Register Category';
        $menu->parent_id = '12';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '25';
        $menu->save();


        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-pos-exchange';
        $menu->title = 'Exchange Rate';
        $menu->parent_id = '23';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '26';
        $menu->save();


        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-pos-transfer';
        $menu->title = 'Stock Transfer';
        $menu->parent_id = '12';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '27';
        $menu->save();


        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-pos-countstock';
        $menu->title = 'Count Stock';
        $menu->parent_id = '12';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '28';
        $menu->save();



        $menu = new Menu();
        $menu->icon = 'Users';
        $menu->pagename = 'side-menu-user';
        $menu->title = 'User Account';
        $menu->parent_id = null;
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '29';
        $menu->save();

        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-user-profile';
        $menu->title = 'Profile';
        $menu->parent_id = '29';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '30';
        $menu->save();


        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-main-order';
        $menu->title = 'Order Menu';
        $menu->parent_id = '8';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '31';
        $menu->save();

        $menu = new Menu();
        $menu->icon = 'Layers';
        $menu->pagename = 'side-menu-somnong';
        $menu->title = 'Sømnøng';
        $menu->parent_id = null;
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '32';
        $menu->save();


        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-somnong-customer';
        $menu->title = 'Register Clients';
        $menu->parent_id = '32';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '33';
        $menu->save();


        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-somnong-quote';
        $menu->title = 'Register Quotes';
        $menu->parent_id = '32';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '34';
        $menu->save();


        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-somnong-payment';
        $menu->title = 'Payment In/Out';
        $menu->parent_id = '32';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '35';
        $menu->save();


        $menu = new Menu();
        $menu->icon = 'Layers';
        $menu->pagename = 'side-menu-somnong-Auth';
        $menu->title = 'Sømnøng Authorize';
        $menu->parent_id = null;
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '36';
        $menu->save();


        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-so-auth-quotes';
        $menu->title = 'Quote';
        $menu->parent_id = '36';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '37';
        $menu->save();

        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-so-auth-payment';
        $menu->title = 'Payment';
        $menu->parent_id = '36';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '38';
        $menu->save();

        $menu = new Menu();
        $menu->icon = 'Layers';
        $menu->pagename = 'side-menu-somnong-report';
        $menu->title = 'Sømnøng Report';
        $menu->parent_id = null;
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '39';
        $menu->save();


        $menu = new Menu();
        $menu->icon = 'Layers';
        $menu->pagename = 'side-menu-somnong-tools';
        $menu->title = 'Sømnøng Tools';
        $menu->parent_id = null;
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '40';
        $menu->save();


        $menu = new Menu();
        $menu->icon = 'Layers';
        $menu->pagename = 'side-menu-somnong-staffinfo';
        $menu->title = 'Register Staff';
        $menu->parent_id = 40;
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '40';
        $menu->save();

        $menu = new Menu();
        $menu->icon = 'Layers';
        $menu->pagename = 'side-menu-somnong-issue';
        $menu->title = 'Register issue';
        $menu->parent_id = 40;
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '41';
        $menu->save();


        $menu = new Menu();
        $menu->icon = 'Layers';
        $menu->pagename = 'side-menu-somnong-report_list';
        $menu->title = 'Report List';
        $menu->parent_id = 39;
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '42';
        $menu->save();

        $menu = new Menu();
        $menu->icon = 'Layers';
        $menu->pagename = 'side-menu-somnong-report_list';
        $menu->title = 'Report issue';
        $menu->parent_id = 39;
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '43';
        $menu->save();

        $menu = new Menu();
        $menu->icon = 'Activity';
        $menu->pagename = 'side-menu-permission';
        $menu->title = 'Permission';
        $menu->parent_id = '8';
        $menu->ignore = '0';
        $menu->active = '1';
        $menu->ordering = '300';
        $menu->save();


    }
}
