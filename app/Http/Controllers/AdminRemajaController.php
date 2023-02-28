<?php

namespace App\Http\Controllers;

use App\Exports\RemajaExport;
use App\Models\Kecamatan;
use App\Models\Penduduk;
use App\Models\Remaja;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminRemajaController extends Controller
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
            $remaja = $this->filter($start, $end, $kecamatan_id);
        } else {
            if ($cari) {
                $remaja = Remaja::whereYear('tanggal', $tahun)->where('nik', 'like', '%' . $cari . '%')->latest()->paginate(10);
            } else {
                $remaja = Remaja::whereYear('tanggal', $tahun)->latest()->paginate(10);
            }
        }
        $data = [
            'title'   => 'Manajemen Data Tahunan Penduduk',
            'remaja' => $remaja,
            'content' => 'admin/remaja/index'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    function filter($start, $end, $kecamatan_id)
    {

        $remaja = Remaja::wherekecamatanId($kecamatan_id)->whereBetween('tanggal', [$start, $end])->paginate(10);
        return $remaja;
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
            'content' => 'admin/remaja/add'
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
            'nik'                   => 'required',
            'no_kk'                 => 'required',
            'tanggal'                 => 'required',
            'kesertaan_pikr'                 => 'required',
            'keaktifan_pikr'                 => 'required',
        ]);
        $data['user_id']    = auth()->user()->id;
        // $keluarga = Datakeluarga::whereNoKk($request->no_kk)->first();



        $penduduk = Penduduk::whereNik($data['nik'])->first();
        $data['nama']              = $penduduk->nama;
        $data['umur']              = hitung_umur($penduduk->tanggal_lahir);
        $data['jenis_kelamin']     = $penduduk->jenis_kelamin;


        $data['kecamatan_id']   = $penduduk->kecamatan_id;
        $data['desa_id']   = $penduduk->desa_id;
        $data['dusun_id']   = $penduduk->dusun_id;
        $data['rt_id']   = $penduduk->rt_id;

        Remaja::create($data);
        toast('Data Sukses ditambahkan', 'success');
        return redirect('/admin/dp/keluarga/' . getTheSession('keluarga_id') . '?page=remaja');
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
            'title'   => 'Data Remaja',
            'remaja' => Remaja::with('remaja')->whereNoKk($no_kk)->first(),
            'content' => 'admin/remaja/show'
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
        $remaja = Remaja::find($id);
        $penduduk = $this->dataPenduduk(request('nik'));
        $data = [
            'title'   => 'Edit Remaja',
            'remaja' => $remaja,
            'penduduk' => $penduduk,
            'content' => 'admin/remaja/add'
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
        $remaja = Remaja::find($id);
        $data = $request->validate([
            'nik'                   => 'required',
            'no_kk'                 => 'required',
            'tanggal'                 => 'required',
            'kesertaan_pikr'                 => 'required',
            'keaktifan_pikr'                 => 'required',
        ]);
        $data['user_id']    = auth()->user()->id;
        // $keluarga = Datakeluarga::whereNoKk($request->no_kk)->first();

        $penduduk = Penduduk::whereNik($data['nik'])->first();
        $data['nama']              = $penduduk->nama;
        $data['umur']              = hitung_umur($penduduk->tanggal_lahir);
        $data['jenis_kelamin']     = $penduduk->jenis_kelamin;

        $data['kecamatan_id']   = $penduduk->kecamatan_id;
        $data['desa_id']   = $penduduk->desa_id;
        $data['dusun_id']   = $penduduk->dusun_id;
        $data['rt_id']   = $penduduk->rt_id;

        $remaja->update($data);
        toast('Data Sukses diubah', 'success');
        return redirect('/admin/dp/keluarga/' . getTheSession('keluarga_id') . '?page=remaja');
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
        $remaja = Remaja::find($id);
        $remaja->delete();
        toast('Data Sukses dihapus', 'success');
        return redirect('/admin/dp/keluarga/' . getTheSession('keluarga_id') . '?page=remaja');
    }


    function export()
    {
        $start = request('tanggal_start');
        $end = request('tanggal_end');
        $kecamatan_id = request('kecamatan_id');
        $kecamatan = Kecamatan::find($kecamatan_id);

        $name = 'data-stunting-kecamatan-' . $kecamatan->name . '-' . $start . '-Hingga-' . $end;

        return Excel::download(new RemajaExport($start, $end, $kecamatan_id), $name . '.xlsx');
    }
}
