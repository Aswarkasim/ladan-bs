<?php

namespace App\Http\Controllers;

use App\Exports\IbuhamilExport;
use App\Models\Ibuhamil;
use App\Models\Kecamatan;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminIbuHamilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cari = request('cari');
        $tahun = auth()->user()->tahun;
        $start = request('tanggal_start');
        $end = request('tanggal_end');
        $kecamatan_id = request('kecamatan_id');

        if ($start) {
            $ibuhamil = $this->filter($start, $end, $kecamatan_id);
        } else {
            if ($cari) {
                $ibuhamil = Ibuhamil::whereYear('tanggal', $tahun)->where('nik', 'like', '%' . $cari . '%')->latest()->paginate(10);
            } else {
                $ibuhamil = Ibuhamil::whereYear('tanggal', $tahun)->latest()->paginate(10);
            }
        }

        $data = [
            'title'   => 'Manajemen Data Tahunan Penduduk',
            'ibuhamil' => $ibuhamil,
            'content' => 'admin/ibuhamil/index'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    function filter($start, $end, $kecamatan_id)
    {

        $ibuhamil = Ibuhamil::wherekecamatanId($kecamatan_id)->whereBetween('tanggal', [$start, $end])->paginate(10);
        return $ibuhamil;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $suami = $this->dataPenduduk(request('nik_suami'));
        $istri = $this->dataPenduduk(request('nik_istri'));

        $data = [
            'title'   => 'Manajemen Data Tahunan Penduduk',
            'suami'  => $suami,
            'istri'  => $istri,
            'content' => 'admin/ibuhamil/add'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    private function dataPenduduk($nik)
    {
        if ($nik != '') {
            $penduduk = Penduduk::whereNik($nik)->first();
            if ($penduduk == false) {
                $penduduk = 'kosong';
                toast('Data tidak ditemukan', 'error');
            } else {
                toast('Data ditemukan', 'success');
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
            'nik_istri'             => 'required',
            'tanggal'                 => 'required',
            'kehamilan_keberapa'    => 'required',
            'tanggal_mulai_hamil'   => 'required',
            'jenis_kehamilan'       => 'required',
            // 'perkiraan_kelahiran'   => 'required',
            // 'tanggal_kelahiran'     => 'required',
            'status'      => 'required',
        ]);

        $data['perkiraan_melahirkan'] = $request->perkiraan_melahirkan;
        $data['tanggal_kelahiran'] = $request->tanggal_kelahiran;
        $data['user_id']    = auth()->user()->id;

        $penduduk = Penduduk::whereNik($data['nik_istri'])->first();
        $data['nama_istri']   = $penduduk->nama;
        $data['jenis_kelamin']   = $penduduk->jenis_kelamin;
        $data['tanggal_lahir']   = $penduduk->tanggal_lahir;

        $data['kecamatan_id']   = $penduduk->kecamatan_id;
        $data['desa_id']   = $penduduk->desa_id;
        $data['dusun_id']   = $penduduk->dusun_id;
        $data['rt_id']   = $penduduk->rt_id;

        Ibuhamil::create($data);
        toast('Data Sukses ditambahkan', 'success');
        return redirect('/admin/dp/keluarga/' . getTheSession('keluarga_id') . '?page=ibuhamil');
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
            'title'   => 'Data Ibuhamil',
            'ibuhamil' => Ibuhamil::with('ibuhamil')->whereNoKk($no_kk)->first(),
            'content' => 'admin/ibuhamil/show'
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
        $ibuhamil = Ibuhamil::find($id);
        $suami = $this->dataPenduduk(request('nik_suami'));
        $istri = $this->dataPenduduk(request('nik_istri'));

        $data = [
            'title'   => 'Edit Ibuhamil',
            'ibuhamil' => $ibuhamil,
            'suami'  => $suami,
            'istri'  => $istri,
            'content' => 'admin/ibuhamil/add'
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
        $ibuhamil = Ibuhamil::find($id);
        $data = $request->validate([
            'no_kk'                 => 'required',
            'nik_istri'             => 'required',
            'tanggal'                 => 'required',
            'kehamilan_keberapa'    => 'required',
            'tanggal_mulai_hamil'   => 'required',
            'jenis_kehamilan'       => 'required',
            // 'perkiraan_kelahiran'   => 'required',
            // 'tanggal_kelahiran'     => 'required',
            'status'      => 'required',
        ]);

        $data['perkiraan_melahirkan'] = $request->perkiraan_melahirkan;
        $data['tanggal_kelahiran'] = $request->tanggal_kelahiran;
        $data['user_id']    = auth()->user()->id;

        $penduduk = Penduduk::whereNik($data['nik_istri'])->first();
        $data['nama_istri']   = $penduduk->jenis_kelamin;
        $data['jenis_kelamin']   = $penduduk->jenis_kelamin;
        $data['tanggal_lahir']   = $penduduk->tanggal_lahir;

        $data['kecamatan_id']   = $penduduk->kecamatan_id;
        $data['desa_id']   = $penduduk->desa_id;
        $data['dusun_id']   = $penduduk->dusun_id;
        $data['rt_id']   = $penduduk->rt_id;



        $ibuhamil->update($data);
        toast('Data Sukses diubah', 'success');
        return redirect('/admin/dp/keluarga/' . getTheSession('keluarga_id') . '?page=ibuhamil');
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
        $ibuhamil = Ibuhamil::find($id);
        $ibuhamil->delete();
        toast('Data Sukses dihaibuhamil', 'success');
        return redirect('/admin/dp/keluarga/' . getTheSession('keluarga_id') . '?page=ibuhamil');
    }


    function export()
    {
        $start = request('tanggal_start');
        $end = request('tanggal_end');
        $kecamatan_id = request('kecamatan_id');
        $kecamatan = Kecamatan::find($kecamatan_id);

        $name = 'data-ibuhamil-kecamatan-' . $kecamatan->name . '-' . $start . '-Hingga-' . $end;

        return Excel::download(new IbuhamilExport($start, $end, $kecamatan_id), $name . '.xlsx');
    }
}
