<?php

namespace App\Http\Controllers;

use App\Exports\DatapendudukExport;
use App\Models\Datakeluarga;
use App\Models\Datapenduduk;
use App\Models\Kecamatan;
use App\Models\Keluarga;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminDatapendudukController extends Controller
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
            $datapenduduk = $this->filter($start, $end, $kecamatan_id);
        } else {
            if ($cari) {
                $datapenduduk = Datapenduduk::whereYear('tanggal', $tahun)->where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
            } else {
                $datapenduduk = Datapenduduk::whereYear('tanggal', $tahun)->latest()->paginate(10);
            }
        }



        $data = [
            'title'   => 'Manajemen Data Tahunan Penduduk',
            'datapenduduk' => $datapenduduk,
            'kecamatan' => Kecamatan::get(),
            'content' => 'admin/datapenduduk/index'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    function filter($start, $end, $kecamatan_id)
    {

        $datapenduduk = Datapenduduk::wherekecamatanId($kecamatan_id)->whereBetween('tanggal', [$start, $end])->paginate(10);
        return $datapenduduk;
    }


    function dataPendudukByNik()
    {
        $nik = request('nik');
        $datapenduduk = Datapenduduk::whereNik($nik)->latest()->paginate(10);

        $data = [
            'title'   => 'Manajemen Data Tahunan Penduduk',
            'datapenduduk' => $datapenduduk,
            'content' => 'admin/datapenduduk/index'
        ];
        return view('admin/layouts/wrapper', $data);
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
            'content' => 'admin/datapenduduk/add'
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
            'tanggal'                 => 'required',
            // 'alamat'                => 'required',
            // 'usia_kawin_pertama'    => 'required',
            'pekerjaan'             => 'required',
            'status_perkawinan'     => 'required',
            'pbi'                   => 'required',
            'bpjs'                  => 'required',
            'asuransi_swasta'              => 'required',
            'kepemilikan_ktp'       => 'required',
            'status_dalam_kk'       => 'required',
            'pendidikan_terakhir'            => 'required',
            'memiliki_akta_kelahiran'   => 'required',
        ]);
        $data['user_id']    = auth()->user()->id;
        $no_kk = getTheSession('no_kk');
        $penduduk = Penduduk::whereNik($data['nik'])->first();
        $data['nama']              = $penduduk->nama;
        $data['tanggal_lahir']              = $penduduk->tanggal_lahir;
        $data['jenis_kelamin']     = $penduduk->jenis_kelamin;


        $data['kecamatan_id']   = $penduduk->kecamatan_id;
        $data['desa_id']   = $penduduk->desa_id;
        $data['dusun_id']   = $penduduk->dusun_id;
        $data['rt_id']   = $penduduk->rt_id;
        // $keluarga = Datakeluarga::whereNoKk($request->no_kk)->first();
        Datapenduduk::create($data);
        toast('Data Sukses ditambahkan', 'success');
        return redirect('/admin/tahunan/datapenduduk/bynik?nik=' . $data['nik']);
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
            'title'   => 'Data Datapenduduk',
            'datapenduduk' => Datapenduduk::with('datapenduduk')->whereNoKk($no_kk)->first(),
            'content' => 'admin/datapenduduk/show'
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
        $datapenduduk = Datapenduduk::find($id);
        $penduduk = $this->dataPenduduk(request('nik'));
        $data = [
            'title'   => 'Edit Datapenduduk',
            'datapenduduk' => $datapenduduk,
            'penduduk' => $penduduk,
            'content' => 'admin/datapenduduk/add'
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
        $datapenduduk = Datapenduduk::find($id);
        $data = $request->validate([
            'nik'                 => 'required',
            'tanggal'                 => 'required',
            // 'alamat'                => 'required',
            // 'usia_kawin_pertama'    => 'required',
            'pekerjaan'             => 'required',
            'status_perkawinan'     => 'required',
            'pbi'                   => 'required',
            'bpjs'                  => 'required',
            'asuransi_swasta'              => 'required',
            'kepemilikan_ktp'       => 'required',
            'status_dalam_kk'       => 'required',
            'pendidikan_terakhir'            => 'required',
            'memiliki_akta_kelahiran'   => 'required',
        ]);
        $data['user_id']    = auth()->user()->id;
        $no_kk = getTheSession('no_kk');
        $penduduk = Penduduk::whereNik($data['nik'])->first();
        $data['nama']              = $penduduk->nama;
        $data['umur']              = hitung_umur($penduduk->tanggal_lahir);
        $data['jenis_kelamin']     = $penduduk->jenis_kelamin;


        $data['kecamatan_id']   = $penduduk->kecamatan_id;
        $data['desa_id']   = $penduduk->desa_id;
        $data['dusun_id']   = $penduduk->dusun_id;
        $data['rt_id']   = $penduduk->rt_id;


        $datapenduduk->update($data);
        $keluarga = Datakeluarga::whereNoKk($request->no_kk)->first();
        toast('Data Sukses diubah', 'success');
        return redirect('/admin/tahunan/datapenduduk/bynik?nik=' . $data['nik']);
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
        $datapenduduk = Datapenduduk::find($id);
        $datapenduduk->delete();
        $keluarga = Datakeluarga::whereNoKk($datapenduduk->no_kk)->first();
        toast('Data Sukses dihapus', 'success');
        return redirect('/admin/tahunan/keluarga/' . $keluarga->id . '?no_kk=' . $keluarga->no_kk);
    }

    function export()
    {
        $start = request('tanggal_start');
        $end = request('tanggal_end');
        $kecamatan_id = request('kecamatan_id');

        return Excel::download(new DatapendudukExport($start, $end, $kecamatan_id), 'datapenduduk.xlsx');
    }
}
