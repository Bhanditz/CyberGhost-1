<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Torann\GeoIP\GeoIP;

class DummyPageController extends Controller {

    protected $envService;

    public function __construct(EnvController $envService) {
        $this->envService = $envService;
    }

    public function index() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'] . "HTTP_CLIENT_IP";
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'] . "HTTP_X_FORWARDED_FOR IP";
        } else {
            $ip = $_SERVER['REMOTE_ADDR'] . " REMOTE ADDR IP";
        }

        $ip1 = "86.127.44.149"; //Testing for real IP Address
        $location = geoip($ip);


        $files = [];
        foreach (glob("/usr/share/nginx/CyberGhost/config/*.php") as $file) {
            array_push($files, str_replace("/usr/share/nginx/CyberGhost/config/", "", $file));
        }

        return view('dummy')
                        ->with('os', $this->envService->getOS())
                        ->with('browser', $this->envService->getBrowserInfo())
                        ->with('ip', $ip)
                        ->with('location', $location)
                        ->with('files', $files)
                        ->with('locale', substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));
    }

}
