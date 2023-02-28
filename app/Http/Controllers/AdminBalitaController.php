<?php

namespace App\Http\Controllers;

use App\Exports\BalitaExport;
use App\Models\Balita;
use App\Models\Kecamatan;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminBalitaController extends Controller
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
            $balita = $this->filter($start, $end, $kecamatan_id);
        } else {
            if ($cari) {
                $balita = Balita::whereYear('tanggal', $tahun)->where('nik', 'like', '%' . $cari . '%')->latest()->paginate(10);
            } else {
                $balita = Balita::whereYear('tanggal', $tahun)->latest()->paginate(10);
            }
        }

        $data = [
            'title'   => 'Manajemen Data Tahunan Penduduk',
            'balita' => $balita,
            'content' => 'admin/balita/index'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    function filter($start, $end, $kecamatan_id)
    {

        $balita = Balita::wherekecamatanId($kecamatan_id)->whereBetween('tanggal', [$start, $end])->paginate(10);
        return $balita;
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
            'content' => 'admin/balita/add'
        ];
        return view('admin.layouts.wrapper', $data);
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
            'poktan_bkb'                 => 'required',
        ]);
        $data['user_id']    = auth()->user()->id;

        $penduduk = Penduduk::whereNik($data['nik'])->first();
        $data['nama']   = $penduduk->jenis_kelamin;
        $data['jenis_kelamin']   = $penduduk->jenis_kelamin;
        $data['tanggal_lahir']   = $penduduk->tanggal_lahir;

        $data['kecamatan_id']   = $penduduk->kecamatan_id;
        $data['desa_id']   = $penduduk->desa_id;
        $data['dusun_id']   = $penduduk->dusun_id;
        $data['rt_id']   = $penduduk->rt_id;


        Balita::create($data);
        toast('Data Sukses ditambahkan', 'success');
        return redirect('/admin/dp/keluarga/' . getTheSession('keluarga_id') . '?page=balita');
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
            'title'   => 'Data Balita',
            'balita' => Balita::with('balita')->whereNoKk($no_kk)->first(),
            'content' => 'admin/balita/show'
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
        $balita = Balita::find($id);
        $penduduk = $this->dataPenduduk(request('nik'));
        $data = [
            'title'   => 'Edit Balita',
            'balita' => $balita,
            'penduduk' => $penduduk,
            'content' => 'admin/balita/add'
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
        $balita = Balita::find($id);
        $data = $request->validate([
            'nik'                 => 'required',
            'no_kk'                 => 'required',
            'tanggal'                 => 'required',
            'poktan_bkb'                 => 'required',
        ]);
        $data['user_id']    = auth()->user()->id;

        $penduduk = Penduduk::whereNik($data['nik'])->first();
        $data['nama']   = $penduduk->jenis_kelamin;
        $data['jenis_kelamin']   = $penduduk->jenis_kelamin;
        $data['tanggal_lahir']   = $penduduk->tanggal_lahir;

        $data['kecamatan_id']   = $penduduk->kecamatan_id;
        $data['desa_id']   = $penduduk->desa_id;
        $data['dusun_id']   = $penduduk->dusun_id;
        $data['rt_id']   = $penduduk->rt_id;

        $balita->update($data);
        toast('Data Sukses diubah', 'success');
        return redirect('/admin/dp/keluarga/' . getTheSession('keluarga_id') . '?page=balita');
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
        $balita = Balita::find($id);
        $balita->delete();
        toast('Data Sukses dihabalita', 'success');
        return redirect('/admin/dp/keluarga/' . getTheSession('keluarga_id') . '?page=balita');
    }

    function export()
    {
        $start = request('tanggal_start');
        $end = request('tanggal_end');
        $kecamatan_id = request('kecamatan_id');
        $kecamatan = Kecamatan::find($kecamatan_id);

        $name = 'data-balita-kecamatan-' . $kecamatan->name . '-' . $start . '-Hingga-' . $end;

        return Excel::download(new BalitaExport($start, $end, $kecamatan_id), $name . '.xlsx');
    }
}
