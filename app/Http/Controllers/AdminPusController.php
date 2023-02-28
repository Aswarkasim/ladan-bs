<?php

namespace App\Http\Controllers;

use App\Exports\PusExport;
use App\Models\Kecamatan;
use App\Models\Penduduk;
use App\Models\Pus;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminPusController extends Controller
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
            $pus = $this->filter($start, $end, $kecamatan_id);
        } else {
            if ($cari) {
                $pus = Pus::whereYear('tanggal', $tahun)->where('nik', 'like', '%' . $cari . '%')->latest()->paginate(10);
            } else {
                $pus = Pus::whereYear('tanggal', $tahun)->latest()->paginate(10);
            }
        }

        $data = [
            'title'   => 'Manajemen Data Tahunan Penduduk',
            'pus' => $pus,
            'content' => 'admin/pus/index'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    function filter($start, $end, $kecamatan_id)
    {

        $pus = Pus::wherekecamatanId($kecamatan_id)->whereBetween('tanggal', [$start, $end])->paginate(10);
        return $pus;
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
            'content' => 'admin/pus/add'
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
            'nik_suami'                 => 'required',
            'nik_istri'                 => 'required',
            'tanggal'                 => 'required',
            'kelompok_umur'                 => 'required',
            'kesertaan_berkb'                 => 'required',
            'jika_tidak_berkb'                 => 'required',
            'jalur'                 => 'required',
        ]);
        $data['user_id']    = auth()->user()->id;
        $suami = Penduduk::whereNik($data['nik_istri'])->first();
        $istri = Penduduk::whereNik($data['nik_istri'])->first();

        $data['nama_istri']   = $istri->nama;
        $data['nama_suami']   = $suami->nama;


        $data['kecamatan_id']   = $suami->kecamatan_id;
        $data['desa_id']   = $suami->desa_id;
        $data['dusun_id']   = $suami->dusun_id;
        $data['rt_id']   = $suami->rt_id;


        Pus::create($data);
        toast('Data Sukses ditambahkan', 'success');
        return redirect('/admin/dp/keluarga/' . getTheSession('keluarga_id') . '?page=pus');
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
            'title'   => 'Data Pus',
            'pus' => Pus::with('pus')->whereNoKk($no_kk)->first(),
            'content' => 'admin/pus/show'
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
        $pus = Pus::find($id);
        $suami = $this->dataPenduduk(request('nik_suami'));
        $istri = $this->dataPenduduk(request('nik_istri'));

        $data = [
            'title'   => 'Edit Pus',
            'pus' => $pus,
            'suami'  => $suami,
            'istri'  => $istri,
            'content' => 'admin/pus/add'
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
        $pus = Pus::find($id);
        $data = $request->validate([
            'no_kk'                 => 'required',
            'nik_suami'                 => 'required',
            'nik_istri'                 => 'required',
            'tanggal'                 => 'required',
            'kelompok_umur'                 => 'required',
            'kesertaan_berkb'                 => 'required',
            'jika_tidak_berkb'                 => 'required',
            'jalur'                 => 'required',
        ]);
        $data['user_id']    = auth()->user()->id;
        $pus->update($data);
        toast('Data Sukses diubah', 'success');
        return redirect('/admin/dp/keluarga/' . getTheSession('keluarga_id') . '?page=pus');
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
        $pus = Pus::find($id);
        $pus->delete();
        toast('Data Sukses dihapus', 'success');
        return redirect('/admin/dp/keluarga/' . getTheSession('keluarga_id') . '?page=pus');
    }

    function export()
    {
        $start = request('tanggal_start');
        $end = request('tanggal_end');
        $kecamatan_id = request('kecamatan_id');
        $kecamatan = Kecamatan::find($kecamatan_id);

        $name = 'data-pus-kecamatan-' . $kecamatan->name . '-' . $start . '-Hingga-' . $end;

        return Excel::download(new PusExport($start, $end, $kecamatan_id), $name . '.xlsx');
    }
}
