<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kategori::all();

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $this->validate($request, [
            'kategori' => 'required|unique:kategoris',
            'keterangan' => 'required'
        ]);

        $kategori = Kategori::create($request->all());

        if ($kategori) {
            return response()->json([
                'pesan' => "data sudah disimpan",
                'data' => $kategori
            ]);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        return response()->json([
            'pesan' => 'ini adalah method store'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = Kategori::where('idkategori', $id)->get();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kategori = Kategori::where('idkategori', $id)->update($request->all());
        if ($kategori) {        
            return response()->json([
                'pesan' =>  'data sudah diupdate',
                'data' => $kategori
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Kategori::where('idkategori', $id)->delete();

        if ($data) {
            return response()->json([
                'pesan' => 'data berhasil dihapus',
                'data' => $data
            ]);
        }        
    }
}
