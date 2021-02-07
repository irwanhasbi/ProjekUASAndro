<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DataController extends Controller
{

    public function show()
    {
        $title = 'Create Place';
        return view('admin/create_place', ['title' => $title]);
    }

    public function showUpdate($id)
    {

        $menu = Menu::find($id);

        $data = [
            'title' => 'Update Place',
            'menu' => $menu
        ];

        return view('admin/update_place', $data);
    }

    public function create(Request $request)
    {
        $file = $request->file('gambar_menu');
        $gambar = '';

        if (isset($file)) {
            $gambar = uniqid('upload-') . '.' . $file->extension();

            $menu = Menu::create([
                'nama_menu' => $request->post('nama_menu'),
                'harga_menu' => $request->post('harga_menu'),
                'gambar_menu' => $gambar,
                'jenis_menu' => $request->post('jenis_menu')
            ]);

            if ($menu) {
                $file->storeAs('places/', $gambar, 'images');

                return redirect()->route('list_place')
                    ->with('status', 'Data Added Successfully!')
                    ->with('class', 'success');
            } else {
                return redirect()->route('list_place')
                    ->with('status', 'Failed to add data!')
                    ->with('class', 'danger');
            }
        } else {
            return redirect()->route('list_place')
                ->with('status', 'Gambar tidak ada!')
                ->with('class', 'danger');
        }
    }

    public function update(Request $request)
    {
        $id = $request->post('id');
        $menu = Menu::find($id);
        $file = $request->file('gambar_menu');

        if (isset($file)) {
            $delete = Storage::disk('images')->delete('places/' . $menu->gambar_menu);

            if ($delete) {
                $gambar = uniqid('upload-') . '.' . $file->extension();
                $file->storeAs('places/', $gambar, 'images');

                $update = $menu->update([
                    'nama_menu' => $request->post('nama_menu'),
                    'harga_menu' => $request->post('harga_menu'),
                    'gambar_menu' => $gambar,
                    'jenis_menu' => $request->post('jenis_menu')
                ]);

                if ($update) {
                    return redirect()->route('list_place')
                        ->with('status', 'Data berhasil di update !')
                        ->with('class', 'success');
                } else {
                    return redirect()->route('list_place')
                        ->with('status', 'Data gagal update!')
                        ->with('class', 'danger');
                }
            } else {
                return redirect()->route('list_place')
                        ->with('status', 'Data gagal update!')
                        ->with('class', 'danger');
            }
        }
    }

    public function delete($id)
    {
        $menu = Menu::find($id);
        $delete = Storage::disk('images')->delete('places/' . $menu->gambar_menu);

        if ($delete) {
            if ($menu->delete()) {
                return redirect()->back()
                    ->with('status', 'Data & File has been deleted!')
                    ->with('class', 'success');
            } else {
                return redirect()->back()
                    ->with('status', 'Failed to delete file!')
                    ->with('class', 'danger');
            }
        } else {
            return redirect()->back()
                ->with('status', 'Failed to delete data!')
                ->with('class', 'danger');
        }
    }
}
