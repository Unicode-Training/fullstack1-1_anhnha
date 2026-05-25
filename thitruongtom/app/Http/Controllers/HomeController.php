<?php

namespace App\Http\Controllers;

use App\Crawl\Crawl;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $crawl = new Crawl();
        $crawl->handle();
        return view('home');
    }
}
