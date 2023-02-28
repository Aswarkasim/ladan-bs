<?php

namespace App\Exports;

use App\Models\Stunting;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class StuntingExport implements FromView
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
        return Stunting::all();
    }

    function view(): View
    {
        $data['stunting'] = Stunting::whereKecamatanId($this->kecamatan_id)->whereBetween('tanggal', [$this->tanggal_start, $this->tanggal_end])->get();
        return view('admin.stunting.export', $data);
    }
}
