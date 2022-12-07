<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment = Payment::all();
        return $payment;
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
        $table = Payment::create([
            "nama_user" => $request->nama_user,
            "email" => $request->email,
            "no_hp" => $request->no_hp,
            "nama_tiket" => $request->nama_tiket,
            "jumlah_tiket" => $request->jumlah_tiket,
            "total_harga" => $request->total_harga,
        ]);

        return response()->json([
            'success' => 201,
            'message' => 'Pembayaran Berhasil!',
            'data' => $table
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = Payment::find($id);
        if ($payment) {
            return response()->json([
                'status' => 200,
                'data' => $payment
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'id ' . $id . ' tidak ditemukan'
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
        $payment = Payment::find($id);
        if($payment){
            $payment->nama_user = $request->nama_user ? $request->nama_user : $payment->nama_user;
            $payment->email = $request->email ? $request->email : $payment->email;
            $payment->no_hp = $request->no_hp ? $request->no_hp : $payment->no_hp;
            $payment->nama_tiket = $request->nama_tiket ? $request->nama_tiket : $payment->nama_tiket;
            $payment->jumlah_tiket = $request->jumlah_tiket ? $request->jumlah_tiket : $payment->jumlah_tiket;
            $payment->total_harga = $request->total_harga ? $request->total_harga : $payment->total_harga;
            return response()->json([
                'status' => 200,
                'data' => $payment
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
        $payment = Payment::where('id', $id)->first();
        if($payment){
            $payment->delete();
            return response()->json([
                'status' => 'Pembayaran Berhasil dihapus!',
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'id' . $id .' tidak ditemukan'
            ], 404);
        }
    }
}
