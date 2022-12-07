<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tiket;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiket = Tiket::all();
        return $tiket;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = Tiket::create([
            "nama_tiket" => $request->nama_tiket,
            "deskripsi_tiket" => $request->deskripsi_tiket,
            "jumlah_tiket" => $request->jumlah_tiket,
            "harga_tiket" => $request->harga_tiket,
        ]);

        return response()->json([
            'success' => 201,
            'message' => 'Tiket Berhasil Ditambahkan!',
            'data' => $table
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,)
    {
        $nama = Tiket::where('nama_tiket', $request['nama_tiket'])->first();
        if ($nama) {
            return response()->json([
                'status' => 200,
                'data' => $nama
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'tiket ' . $nama . ' tidak ditemukan'
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tiket = Tiket::find($id);
        if($tiket){
            $tiket->nama_tiket = $request->nama_tiket ? $request->nama_tiket : $tiket->nama_tiket;
            $tiket->deskripsi_tiket = $request->deskripsi_tiket ? $request->deskripsi_tiket : $tiket->deskripsi_tiket;
            $tiket->jumlah_tiket = $request->jumlah_tiket ? $request->jumlah_tiket : $tiket->jumlah_tiket;
            $tiket->harga_tiket = $request->harga_tiket ? $request->harga_tiket : $tiket->harga_tiket;
            $tiket->save();
            return response()->json([
                'status' => 200,
                'data' => $tiket
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => $id . ' tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tiket = Tiket::where('id', $id)->first();
        if($tiket){
            $tiket->delete();
            return response()->json([
                'status' => 'Tiket Berhasil dihapus!',
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'id' . $id .' tidak ditemukan'
            ], 404);
        }
    }

    
}