<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = Event::all();
        return $event;
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
        $table = Event::create([
            "nama_event" => $request->nama_event,
            "artist" => $request->artist,
            "tanggal_event" => $request->tanggal_event,
            "tempat_event" => $request->tempat_event,
            "detail_event" => $request->detail_event,
        ]);

        return response()->json([
            'success' => 201,
            'message' => 'Event Berhasil Ditambahkan!',
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
        $nama = Event::where('nama_event', $request['nama_event'])->first();
        if ($nama) {
            return response()->json([
                'status' => 200,
                'data' => $nama
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'event ' . $nama . ' tidak ditemukan'
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
        $event = Event::find($id);
        if($event){
            $event->nama_event = $request->nama_event ? $request->nama_event : $event->nama_event;
            $event->artist = $request->artist ? $request->artist : $event->artist;
            $event->tanggal_event = $request->tanggal_event ? $request->tanggal_event : $event->tanggal_event;
            $event->tempat_event = $request->tempat_event ? $request->tempat_event : $event->tempat_event;
            $event->detail_event = $request->detail_event ? $request->detail_event : $event->detail_event;
            $event->save();
            return response()->json([
                'status' => 200,
                'data' => $event
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
        $event = Event::where('id', $id)->first();
        if($event){
            $event->delete();
            return response()->json([
                'status' => 'Event Berhasil dihapus!',
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'id' . $id .' tidak ditemukan'
            ], 404);
        }
    }

    
}