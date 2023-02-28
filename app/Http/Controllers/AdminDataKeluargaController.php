<?php

namespace App\Http\Controllers;

use App\Exports\DatakeluargaExport;
use App\Models\Datakeluarga;
use App\Models\Kecamatan;
use App\Models\Keluarga;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminDataKeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // protected


    public function index()
    {
        //
        $cari = request('cari');
        $tahun = auth()->user()->tahun;
        $start = request('tanggal_start');
        $end = request('tanggal_end');
        $kecamatan_id = request('kecamatan_id');

        if ($start) {
            $datakeluarga = $this->filter($start, $end, $kecamatan_id);
        } else {
            if ($cari) {
                $datakeluarga = Datakeluarga::whereYear('tanggal', $tahun)->where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
            } else {
                $datakeluarga = Datakeluarga::whereYear('tanggal', $tahun)->latest()->paginate(10);
            }
        }



        $data = [
            'title'   => 'Manajemen Data Tahunan Keluarga',
            'datakeluarga' => $datakeluarga,
            'kecamatan'     => Kecamatan::get(),
            'content' => 'admin/datakeluarga/index'
        ];
        return view('admin/layouts/wrapper', $data);
    }


    function filter($start, $end, $kecamatan_id)
    {

        $datakeluarga = Datakeluarga::wherekecamatanId($kecamatan_id)->whereBetween('tanggal', [$start, $end])->paginate(10);
        return $datakeluarga;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // die($penduduk);

        $penduduk = $this->dataKeluarga(request('no_kk'));
        // die($penduduk);
        $data = [
            'title'   => 'Manajemen Data Tahunan Keluarga',
            'penduduk'  => $penduduk,
            'content' => 'admin/datakeluarga/add'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    private function dataKeluarga($no_kk)
    {
        if ($no_kk != '') {
            $penduduk = Penduduk::whereNoKk($no_kk)->wherePeran('Kepala Keluarga')->first();
            if ($penduduk == false) {
                $penduduk = 'kosong';
            }
        } else {
            $penduduk = 'kosong';
        }
        return $penduduk;
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
        // print_r($request);
        // die;
        // dd($request);
        $data = $request->validate([
            'no_kk'                 => 'required',
            'tanggal'                 => 'required',
            'tahapan_ks'                => 'required',
        ]);
        $data['user_id']    = auth()->user()->id;

        $no_kk = getTheSession('no_kk');
        $keluarga = Keluarga::whereNoKk($no_kk)->first();
        $data['kecamatan_id']   = $keluarga->kecamatan_id;
        $data['desa_id']   = $keluarga->desa_id;
        $data['dusun_id']   = $keluarga->dusun_id;
        $data['rt_id']   = $keluarga->rt_id;


        Datakeluarga::create($data);
        toast('Data Sukses ditambahkan', 'success');
        return redirect('/admin/dp/keluarga/' . getTheSession('keluarga_id') . '?page=datakeluarga');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $no_kk = request('no_kk');
        $data = [
            'title'   => 'Data Datakeluarga',
            'datakeluarga' => Datakeluarga::with('datakeluarga')->whereNoKk($no_kk)->first(),
            'content' => 'admin/datakeluarga/show'
        ];
        return view('admin/layouts/wrapper', $data);
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
        $datakeluarga = Datakeluarga::find($id);
        $penduduk = $this->dataKeluarga(request('no_kk'));
        $data = [
            'title'   => 'Edit Datakeluarga',
            'datakeluarga' => $datakeluarga,
            'penduduk' => $penduduk,
            'content' => 'admin/datakeluarga/add'
        ];
        return view('admin/layouts/wrapper', $data);
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
        //
        $datakeluarga = Datakeluarga::find($id);
        $data = $request->validate([
            'no_kk'                 => 'required',
            'tanggal'                 => 'required',
            'tahapan_ks'                => 'required',
        ]);
        $data['user_id']    = auth()->user()->id;

        $no_kk = getTheSession('no_kk');
        $keluarga = Keluarga::whereNoKk($no_kk)->first();
        $data['kecamatan_id']   = $keluarga->kecamatan_id;
        $data['desa_id']   = $keluarga->desa_id;
        $data['dusun_id']   = $keluarga->dusun_id;
        $data['rt_id']   = $keluarga->rt_id;


        $datakeluarga->update($data);
        toast('Data Sukses diubah', 'success');
        return redirect('/admin/dp/keluarga/' . getTheSession('keluarga_id') . '?page=datakeluarga');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $datakeluarga = Datakeluarga::find($id);
        $datakeluarga->delete();
        $keluarga = Datakeluarga::whereNoKk($datakeluarga->no_kk)->first();
        toast('Data Sukses dihapus', 'success');
        return redirect('/admin/dp/keluarga/' . getTheSession('keluarga_id') . '?page=datakeluarga');
    }

    function export()
    {
        $start = request('tanggal_start');
        $end = request('tanggal_end');
        $kecamatan_id = request('kecamatan_id');

        return Excel::download(new DatakeluargaExport($start, $end, $kecamatan_id), 'datakeluarga.xlsx');
    }
}
