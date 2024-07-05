<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index()
    {
        $data_pengguna = Pengguna::all();
        return view('index', compact('data_pengguna'));
    }
}
