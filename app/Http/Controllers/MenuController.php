<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Menu::all();
        
        $data = DB::table('menus')
        ->join('kategoris', 'kategoris.idkategori', '=', 'menus.idkategori')
        ->select('menus.*', 'kategoris.kategori')
        ->orderBy('menus.menu', 'asc')
        ->get();

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
            'idkategori' => 'required|numeric',
            'menu' => 'required',
            'gambar' => 'required',
            'harga' => 'required|numeric'
        ]);
        $NamaGambar = $request->file('gambar')->getClientOriginalName();
        $request->file('gambar')->move('upload', $NamaGambar);

        $data = [
            'idkategori' => $request->input(('idkategori')),
            'menu' => $request->input('menu'),
            'gambar' => url('upload/'.$NamaGambar),
            'harga' => $request->input('harga')
        ];                

        $menu = Menu::create($data);
        
        if ($menu) {
            return response()->json([
                'pesan' => "data sudah disimpan",
                'data' => $menu
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = DB::table('menus')
        ->join('kategoris', 'kategoris.idkategori', '=', 'menus.idkategori')
        ->select('menus.*', 'kategoris.kategori')
        ->where('idmenu', '=', $id)
        // ->orderBy('menus.menu', 'asc')
        ->get();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'idkategori' => 'required|numeric',
            'menu' => 'required',            
            'harga' => 'required|numeric'
        ]);

        if ($request->hasFile('gambar')) {
            $NamaGambar = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move('upload', $NamaGambar);
            $data = [
                'idkategori' => $request->input(('idkategori')),
                'menu' => $request->input('menu'),
                'gambar' => url('upload/'.$NamaGambar),
                'harga' => $request->input('harga')
            ];  
        } else {
            $data = [
                'idkategori' => $request->input(('idkategori')),
                'menu' => $request->input('menu'),                
                'harga' => $request->input('harga')
            ];
        }                


        $menu = Menu::where('idmenu', $id)->update($data);

        if ($menu) {        
            return response()->json([
                'pesan' =>  'data sudah diupdate',
                'data' => $menu
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $data = Menu::where('idmenu', $id)->delete();

        if ($data) {
            return response()->json([
                'pesan' => 'data berhasil dihapus',
                'data' => $data
            ]);
        }     
    }
}
