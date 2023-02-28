<?php

namespace App\Http\Controllers;

use App\Exports\StuntingExport;
use App\Models\Indikatorstunting;
use App\Models\Indikatorstuntingpilih;
use App\Models\Kecamatan;
use App\Models\Penduduk;
use App\Models\Stunting;
use App\Models\Keluarga;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminStuntingController extends Controller
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
            $stunting = $this->filter($start, $end, $kecamatan_id);
        } else {
            if ($cari) {
                $stunting = Stunting::whereYear('tanggal', $tahun)->where('nik', 'like', '%' . $cari . '%')->latest()->paginate(10);
            } else {
                $stunting = Stunting::whereYear('tanggal', $tahun)->latest()->paginate(10);
            }
        }
        $data = [
            'title'   => 'Manajemen Data Tahunan Penduduk',
            'stunting' => $stunting,
            'content' => 'admin/stunting/index'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    function filter($start, $end, $kecamatan_id)
    {

        $wus = Stunting::wherekecamatanId($kecamatan_id)->whereBetween('tanggal', [$start, $end])->paginate(10);
        return $wus;
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
            'content' => 'admin/stunting/add'
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
            'tanggal'                 => 'required',
            'jumlah_anggota_keluarga'                 => 'required',
            'jumlah_baduta'                 => 'required',
            'jumlah_balita'                 => 'required',

            'indikator_1'                 => 'required',
            'indikator_2'                 => 'required',
            'indikator_3'                 => 'required',
            'indikator_4'                 => 'required',
            'indikator_5'                 => 'required',
            'indikator_6'                 => 'required',
            'indikator_7'                 => 'required',
            'indikator_8'                 => 'required',
            'indikator_9'                 => 'required',
            'indikator_10'                 => 'required',
            'indikator_11'                 => 'required',
            'indikator_12'                 => 'required',
        ]);
        $data['user_id']    = auth()->user()->id;
        // $keluarga = Datakeluarga::whereNoKk($request->no_kk)->first();

        $no_kk = getTheSession('no_kk');
        $keluarga = Keluarga::whereNoKk($no_kk)->first();
        $data['kecamatan_id']   = $keluarga->kecamatan_id;
        $data['desa_id']   = $keluarga->desa_id;
        $data['dusun_id']   = $keluarga->dusun_id;
        $data['rt_id']   = $keluarga->rt_id;

        Stunting::create($data);
        toast('Data Sukses ditambahkan', 'success');
        return redirect('/admin/dp/keluarga/' . getTheSession('keluarga_id') . '?page=stunting');
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
            'title'   => 'Data Stunting',
            'stunting' => Stunting::with('stunting')->whereNoKk($no_kk)->first(),
            'content' => 'admin/stunting/show'
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
        $stunting = Stunting::find($id);
        $penduduk = $this->dataPenduduk(request('nik'));
        $data = [
            'title'   => 'Edit Stunting',
            'stunting' => $stunting,
            'penduduk' => $penduduk,
            'content' => 'admin/stunting/add'
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
        $stunting = Stunting::find($id);
        $data = $request->validate([
            'no_kk'                 => 'required',
            'tanggal'                 => 'required',
            'jumlah_anggota_keluarga'                 => 'required',
            'jumlah_baduta'                 => 'required',
            'jumlah_balita'                 => 'required',

            'indikator_1'                 => 'required',
            'indikator_2'                 => 'required',
            'indikator_3'                 => 'required',
            'indikator_4'                 => 'required',
            'indikator_5'                 => 'required',
            'indikator_6'                 => 'required',
            'indikator_7'                 => 'required',
            'indikator_8'                 => 'required',
            'indikator_9'                 => 'required',
            'indikator_10'                 => 'required',
            'indikator_11'                 => 'required',
            'indikator_12'                 => 'required',
        ]);
        $data['user_id']    = auth()->user()->id;

        $no_kk = getTheSession('no_kk');
        $keluarga = Keluarga::whereNoKk($no_kk)->first();
        $data['kecamatan_id']   = $keluarga->kecamatan_id;
        $data['desa_id']   = $keluarga->desa_id;
        $data['dusun_id']   = $keluarga->dusun_id;
        $data['rt_id']   = $keluarga->rt_id;


        $stunting->update($data);
        toast('Data Sukses diubah', 'success');
        return redirect('/admin/dp/keluarga/' . getTheSession('keluarga_id') . '?page=stunting');
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
        $stunting = Stunting::find($id);
        $stunting->delete();
        toast('Data Sukses dihapus', 'success');
        return redirect('/admin/dp/keluarga/' . getTheSession('keluarga_id') . '?page=stunting');
    }


    function addIndikator(Request $request)
    {

        $indikator  = Indikatorstunting::find($request->indikatorstunting_id);


        $data['indikatorstunting_id']    = $indikator->id;
        $data['indikator']    = $indikator->desc;

        Indikatorstuntingpilih::create($data);
        return redirect()->back();
    }

    function export()
    {
        $start = request('tanggal_start');
        $end = request('tanggal_end');
        $kecamatan_id = request('kecamatan_id');
        $kecamatan = Kecamatan::find($kecamatan_id);

        $name = 'data-stunting-kecamatan-' . $kecamatan->name . '-' . $start . '-Hingga-' . $end;

        return Excel::download(new StuntingExport($start, $end, $kecamatan_id), $name . '.xlsx');
    }
}
