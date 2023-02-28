<?php

namespace App\Http\Controllers;

use App\Exports\LansiaExport;
use App\Models\Kecamatan;
use App\Models\Keluarga;
use App\Models\Lansia;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminLansiaController extends Controller
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
            $lansia = $this->filter($start, $end, $kecamatan_id);
        } else {
            if ($cari) {
                $lansia = Lansia::whereYear('tanggal', $tahun)->where('nik', 'like', '%' . $cari . '%')->latest()->paginate(10);
            } else {
                $lansia = Lansia::whereYear('tanggal', $tahun)->latest()->paginate(10);
            }
        }
        $data = [
            'title'   => 'Manajemen Data Tahunan Penduduk',
            'lansia' => $lansia,
            'kecamatan'     => Kecamatan::get(),
            'content' => 'admin/lansia/index'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    function filter($start, $end, $kecamatan_id)
    {

        $lansia = Lansia::wherekecamatanId($kecamatan_id)->whereBetween('tanggal', [$start, $end])->paginate(10);
        return $lansia;
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
            'content' => 'admin/lansia/add'
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
            'poktan_bkl'                 => 'required',
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
        Lansia::create($data);
        toast('Data Sukses ditambahkan', 'success');
        return redirect('/admin/dp/keluarga/' . getTheSession('keluarga_id') . '?page=lansia');
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
            'title'   => 'Data Lansia',
            'lansia' => Lansia::with('lansia')->whereNoKk($no_kk)->first(),
            'content' => 'admin/lansia/show'
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
        $lansia = Lansia::find($id);
        $penduduk = $this->dataPenduduk(request('nik'));
        $data = [
            'title'   => 'Edit Lansia',
            'lansia' => $lansia,
            'penduduk' => $penduduk,
            'content' => 'admin/lansia/add'
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
        $lansia = Lansia::find($id);
        $data = $request->validate([
            'nik'                 => 'required',
            'no_kk'                 => 'required',
            'tanggal'                 => 'required',
            'poktan_bkl'                 => 'required',
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

        $lansia->update($data);
        toast('Data Sukses diubah', 'success');
        return redirect('/admin/dp/keluarga/' . getTheSession('keluarga_id') . '?page=lansia');
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
        $lansia = Lansia::find($id);
        $lansia->delete();
        toast('Data Sukses dihapus', 'success');
        return redirect('/admin/dp/keluarga/' . getTheSession('keluarga_id') . '?page=lansia');
    }

    function export()
    {
        $start = request('tanggal_start');
        $end = request('tanggal_end');
        $kecamatan_id = request('kecamatan_id');
        $kecamatan = Kecamatan::find($kecamatan_id);

        $name = 'datalansia-kecamatan-' . $kecamatan->name . '-' . $start . 'Hingga' . $end;

        return Excel::download(new LansiaExport($start, $end, $kecamatan_id), $name . '.xlsx');
    }
}
