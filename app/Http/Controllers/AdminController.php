<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class AdminController extends Controller
{


    public function list_place()
    {
        $data = [
            'title' => 'List Of Place',
            'menus' => Menu::paginate(4)
        ];

        return view('admin/list_place', $data);
    }

}
