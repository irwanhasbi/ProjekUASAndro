<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function showAll()
    {
        $menu = Menu::all();

        foreach ($menu as $item) {
            $item->gambar_menu = $this->getIp() . $item->gambar_menu;
        }

        return response()->json([
            'data' => $menu
        ]);
    }

    public function getIp()
    {
        $ip = gethostbyname(gethostname());
        return str_replace('localhost', $ip, asset('img/places')) . '/';
    }
}
