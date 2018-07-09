<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {

    protected $envService;

    public function __construct(EnvController $envService) {
        $this->envService = $envService;
    }

    public function index() {
        return view('welcome')
                        ->with('os', $this->envService->getOS());
    }

}
