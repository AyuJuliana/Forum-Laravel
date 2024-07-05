<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Komentar;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $forum = Forum::paginate(10);
        return view('forum', compact('forum'));
    }

    public function create()
    {
        return view('add');
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required',
        ]);

        // Simpan data ke dalam database
        Forum::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'user_id' => auth()->id(), // Asumsikan user_id diambil dari user yang sedang login
        ]);

        // Redirect ke halaman yang diinginkan setelah penyimpanan sukses
        return redirect('/forum')->with('success', 'Post successfully added.');
    }

    public function view(Forum $forum){
        return view('viewforum',compact('forum'));
    }

    public function postkomentar(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'konten' => 'required',
            'forum_id' => 'required|exists:forum,id',
            'parent' => 'required|integer',
        ]);
    
        // Tambahkan user_id ke dalam request
        $request->merge(['user_id' => auth()->user()->id]);
    
        // Simpan data komentar ke dalam database
        Komentar::create([
            'konten_komen' => $request->konten, // Sesuaikan ini dengan nama kolom di database Anda
            'forum_id' => $request->forum_id,
            'parent' => $request->parent,
            'user_id' => $request->user_id,
        ]);
    
        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan');
    }
    
}
