<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    
    protected $table = 'menus';

    public $timestamps = false;

    protected $fillable = [
        'gambar_menu',
        'nama_menu',
        'jenis_menu',
        'harga_menu'
    ];
}
