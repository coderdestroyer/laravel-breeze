<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(){
        $mahasiswa = Mahasiswa::all();
        return view('dashboard', compact('mahasiswa'));
    }

    public function store(Request $request){
        request()->validate([
            'nim' => 'required|string|max:255',
            'nama' => 'required|unique:mahasiswas|string|max:255',
        ]);

        Mahasiswa::create($request->all());

        $notifications = [
            'message' => 'Data Berhasil Ditambahkan',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notifications);
        
    }

    public function update(Request $request, Mahasiswa $mahasiswa){
        $request->validate([
            'nim' => 'required|string|max:255',
            'nama' => 'required|string|max:255|unique:mahasiswas,nama,' . $mahasiswa->id,
        ]);

        $mahasiswa->update($request->all());

        $notifications = [
            'message' => 'Data Berhasil Diubah',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notifications);
    }

    public function destroy(Mahasiswa $mahasiswa){
        $mahasiswa->delete();

        $notifications = [
            'message' => 'Data Berhasil Dihapus',
            'alert-type' => 'warning'
        ];

        return redirect()->back()->with($notifications);
    }
}
