<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function index() {
        $workers = Worker::all();
        return view('workers.index', compact('workers'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'nik' => 'required|unique:workers',
        ]);

        Worker::create($request->all());
        return back()->with('success', 'Pekerja berhasil ditambahkan!');
    }

    public function destroy($id) {
        Worker::find($id)->delete();
        return back()->with('success', 'Pekerja berhasil dihapus!');
    }
}