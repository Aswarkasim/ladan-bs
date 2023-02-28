<?php

namespace App\Exports;

use App\Models\Datakeluarga;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DatakeluargaExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $tanggal_start;
    protected $tanggal_end;
    protected $kecamatan_id;
    function __construct($start, $end, $kecamatan_id)
    {
        $this->tanggal_start = $start;
        $this->tanggal_end = $end;
        $this->kecamatan_id = $kecamatan_id;
    }
    public function collection()
    {
        return Datakeluarga::all();
    }

    function view(): View
    {
        // $data['datakeluarga'] = Datapenduduk::whereDate('tanggal', '>=', $this->tanggal_start)->whereDate('tanggal', '<=', $this->tanggal_end)->latest()->paginate(10);
        $data['datakeluarga'] = Datakeluarga::whereKecamatanId($this->kecamatan_id)->whereBetween('tanggal', [$this->tanggal_start, $this->tanggal_end])->get();
        // $data['penduduk'] = Datapenduduk::get();
        // print_r($this->tanggal_start);
        // die;
        // dd($data);
        return view('admin.datakeluarga.export', $data);
    }
}
