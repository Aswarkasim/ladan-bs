<?php

namespace App\Exports;

use App\Models\Lansia;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class LansiaExport implements FromView
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
        return Lansia::all();
    }

    function view(): View
    {
        // $data['lansia'] = Lansia::whereDate('tanggal', '>=', $this->tanggal_start)->whereDate('tanggal', '<=', $this->tanggal_end)->latest()->paginate(10);
        $data['lansia'] = Lansia::whereKecamatanId($this->kecamatan_id)->whereBetween('tanggal', [$this->tanggal_start, $this->tanggal_end])->get();
        // $data['penduduk'] = Lansia::get();
        // print_r($this->tanggal_start);
        // die;
        return view('admin.lansia.export', $data);
    }
}
