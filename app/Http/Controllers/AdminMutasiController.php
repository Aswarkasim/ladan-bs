<?php

namespace App\Http\Controllers;

use App\Exports\MutasiExport;
use App\Models\Kecamatan;
use App\Models\Mutasi;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminMutasiController extends Controller
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
            $mutasi = $this->filter($start, $end, $kecamatan_id);
        } else {
            if ($cari) {
                $mutasi = Mutasi::whereYear('tanggal', $tahun)->where('nik', 'like', '%' . $cari . '%')->latest()->paginate(10);
            } else {
                $mutasi = Mutasi::whereYear('tanggal', $tahun)->latest()->paginate(10);
            }
        }
        $data = [
            'title'   => 'Manajemen Data Tahunan Penduduk',
            'mutasi' => $mutasi,
            'kecamatan'     => Kecamatan::get(),
            'content' => 'admin/mutasi/index'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    function filter($start, $end, $kecamatan_id)
    {

        $mutasi = Mutasi::wherekecamatanId($kecamatan_id)->whereBetween('tanggal', [$start, $end])->paginate(10);
        return $mutasi;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $penduduk = $this->dataPenduduk(request('nik'));

        $data = [
            'title'   => 'Manajemen Data Tahunan Penduduk',
            'penduduk'  => $penduduk,
            'content' => 'admin/mutasi/add'
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
            'nik'                 => 'required',
            'no_kk'                 => 'required',
            'tanggal'                 => 'required',
            'mutasi'                 => 'required',
        ]);
        $data['user_id']    = auth()->user()->id;
        $no_kk = getTheSession('no_kk');
        // $keluarga = Keluarga::whereNoKk($no_kk)->first();

        $penduduk = Penduduk::whereNik($data['nik'])->first();
        $data['nama']   = $penduduk->nama;
        $data['jenis_kelamin']   = $penduduk->jenis_kelamin;
        $data['tanggal_lahir']   = $penduduk->tanggal_lahir;

        $data['kecamatan_id']   = $penduduk->kecamatan_id;
        $data['desa_id']   = $penduduk->desa_id;
        $data['dusun_id']   = $penduduk->dusun_id;
        $data['rt_id']   = $penduduk->rt_id;

        // $keluarga = Datakeluarga::whereNoKk($request->no_kk)->first();
        Mutasi::create($data);
        toast('Data Sukses ditambahkan', 'success');
        return redirect('/admin/dp/keluarga/' . getTheSession('keluarga_id') . '?page=mutasi');
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
            'title'   => 'Data Mutasi',
            'mutasi' => Mutasi::with('mutasi')->whereNoKk($no_kk)->first(),
            'content' => 'admin/mutasi/show'
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
        $mutasi = Mutasi::find($id);
        $penduduk = $this->dataPenduduk(request('nik'));
        $data = [
            'title'   => 'Edit Mutasi',
            'mutasi' => $mutasi,
            'penduduk' => $penduduk,
            'content' => 'admin/mutasi/add'
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
        $mutasi = Mutasi::find($id);
        $data = $request->validate([
            'nik'                 => 'required',
            'no_kk'                 => 'required',
            'tanggal'                 => 'required',
            'mutasi'                 => 'required',
        ]);
        $data['user_id']    = auth()->user()->id;
        $penduduk = Penduduk::whereNik($data['nik'])->first();
        $data['nama']   = $penduduk->nama;
        $data['jenis_kelamin']   = $penduduk->jenis_kelamin;
        $data['tanggal_lahir']   = $penduduk->tanggal_lahir;

        $data['kecamatan_id']   = $penduduk->kecamatan_id;
        $data['desa_id']   = $penduduk->desa_id;
        $data['dusun_id']   = $penduduk->dusun_id;
        $data['rt_id']   = $penduduk->rt_id;

        $mutasi->update($data);
        toast('Data Sukses diubah', 'success');
        return redirect('/admin/dp/keluarga/' . getTheSession('keluarga_id') . '?page=mutasi');
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
        $mutasi = Mutasi::find($id);
        $mutasi->delete();
        toast('Data Sukses dihapus', 'success');
        return redirect('/admin/dp/keluarga/' . getTheSession('keluarga_id') . '?page=mutasi');
    }

    function export()
    {
        $start = request('tanggal_start');
        $end = request('tanggal_end');
        $kecamatan_id = request('kecamatan_id');
        $kecamatan = Kecamatan::find($kecamatan_id);

        $name = 'datamutasi-kecamatan-' . $kecamatan->name . '-' . $start . 'Hingga' . $end;

        return Excel::download(new MutasiExport($start, $end, $kecamatan_id), $name . '.xlsx');
    }
}
