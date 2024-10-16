<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Buat instance controller baru.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan halaman utama untuk pengguna yang sudah login.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $navigationList = [
            ['name' => 'Home', 'svg' => '<svg>...</svg>'],
            ['name' => 'Dashboard', 'svg' => '<svg>...</svg>'],
            ['name' => 'Documents', 'svg' => '<svg>...</svg>'],
            // Add more items as necessary
        ];

        $footerNavigation = [
            ['name' => 'Settings', 'svg' => '<svg>...</svg>'],
            ['name' => 'Log out', 'svg' => '<svg>...</svg>'],
            // Add more footer items as necessary
        ];

        return view('home', compact('navigationList', 'footerNavigation'));
    }
}
