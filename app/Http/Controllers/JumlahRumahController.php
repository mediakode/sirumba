<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\JumlahRumah;
use App\Pemohon;
use Illuminate\Http\Request;

class JumlahRumahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
              for ($i = 0; $i < count($request->tipe); $i++) {       
                $ukuran[] = [
                    'user_id'   => Auth::id(),
                    'pemohon_id' => $request->pemohon_id,
                    'tipe' => $request->tipe[$i],
                    'luas' => $request->luas[$i],
                    'jumlah' => $request->jumlah[$i],
                    'kategori' => $request->kategori[$i],
                    ];
            }
        JumlahRumah::insert($ukuran);
        return response()->json(['pesan'=>'Data jumlah/ukuran kapling berhasil disimpan.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JumlahRumah  $jumlahRumah
     * @return \Illuminate\Http\Response
     */
    public function show(JumlahRumah $jumlahRumah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JumlahRumah  $jumlahRumah
     * @return \Illuminate\Http\Response
     */
    public function edit(JumlahRumah $jumlahRumah)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JumlahRumah  $jumlahRumah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::transaction(function () {

            for ($i = 0; $i < count($request->id); $i++) { 

                DB::table('jumlah_rumah')->where('id', $request->id[$id])
                                         ->delete();

                DB::table('jumlah_rumah')
                        ->where('id',$request->id[$i])
                        ->update([
                            'user_id'    => Auth::id(),
                            'pemohon_id' => $id,
                            'tipe'       => $request->tipe[$i],
                            'luas'       => $request->luas[$i],
                            'jumlah'     => $request->jumlah[$i],
                            'kategori' => $request->kategori[$i],
                            ]);
            }
        });
     

        return response()->json([
            'pesan' => 'Jumlah unit berhasi di update'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JumlahRumah  $jumlahRumah
     * @return \Illuminate\Http\Response
     */
    public function destroy(JumlahRumah $jumlahRumah)
    {
        //
    }

    public function hapus($id){
        $unit = JumlahRumah::find($id);
        $unit->delete();

        return response()->json([
            'pesan' => 'Unit rumah dihapus.'
        ]);
    }
}
