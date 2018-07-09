<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class PricingPageController extends Controller {

    protected $envService;

    public function __construct(EnvController $envService) {
        $this->envService = $envService;
    }

    public function index() {
        if ($this->envService->getOS() == "Ubuntu") {
            $name = Config::get('prices.linux.name');
            switch ($_COOKIE['cookie']['voucher']) {
                case "new member" :
                    $price = Config::get('prices.linux.price') - Config::get('discount.new member.discount');
                    break;
                case "registered now" :
                    $price = Config::get('prices.linux.price') - Config::get('discount.registered now.discount');
                    break;
                default :
                    $price = Config::get('prices.linux.price');
                    break;
            }
        }
//            $price = $_COOKIE['cookie']['voucher'] == "new member" ? Config::get('prices.linux.price') - Config::get('discount.new member.discount') :
//                    $_COOKIE['cookie']['voucher'] == "registered now" ? Config::get('prices.linux.price') - Config::get('discount.registered now.discount') :
//                    Config::get('prices.linux.price');
//        }
        if ($this->envService->getOS() == "Windows") {
            $name = Config::get('prices.windows.name');
            switch ($_COOKIE['cookie']['voucher']) {
                case "new member" :
                    $price = Config::get('prices.windows.price') - Config::get('discount.new member.discount');
                    break;
                case "registered now" :
                    $price = Config::get('prices.windows.price') - Config::get('discount.registered now.discount');
                    break;
                default :
                    $price = Config::get('prices.windows.price');
                    break;
            }
        }

        return view('pricing')
                        ->with('os', $this->envService->getOS())
                        ->with('name', $name)
                        ->with('price', $price);
    }

}
