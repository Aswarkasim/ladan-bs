<?php

namespace App\Exports;

use App\Models\Ibuhamil;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class IbuhamilExport implements FromView
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
        return Ibuhamil::all();
    }

    function view(): View
    {
        // $data['ibuhamil'] = Ibuhamil::whereDate('tanggal', '>=', $this->tanggal_start)->whereDate('tanggal', '<=', $this->tanggal_end)->latest()->paginate(10);
        $data['ibuhamil'] = Ibuhamil::whereKecamatanId($this->kecamatan_id)->whereBetween('tanggal', [$this->tanggal_start, $this->tanggal_end])->get();
        // $data['penduduk'] = Ibuhamil::get();
        // print_r($this->tanggal_start);
        // die;
        return view('admin.ibuhamil.export', $data);
    }
}
