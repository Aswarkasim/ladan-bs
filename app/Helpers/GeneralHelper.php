<?php


function getTheSession($name)
{
    $session =  Illuminate\Support\Facades\Session::get($name);
    return $session;
}
function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    echo $hasil_rupiah;
}

function hitung_umur($tanggal_lahir)
{
    $birthDate = new DateTime($tanggal_lahir);
    $today = new DateTime("today");
    if ($birthDate > $today) {
        exit("0 tahun 0 bulan 0 hari");
    }
    $y = $today->diff($birthDate)->y;
    // $m = $today->diff($birthDate)->m;
    // $d = $today->diff($birthDate)->d;
    return $y;
}


function hitung_umur_bulan($tanggal_lahir)
{
    // $birthDate = new DateTime($tanggal_lahir);
    // $today = new DateTime("today");
    $today = date('y-m-d');
    $ts1 = strtotime($tanggal_lahir);
    $ts2 = strtotime($today);

    $year1 = date('Y', $ts1);
    $year2 = date('Y', $ts2);

    $month1 = date('m', $ts1);
    $month2 = date('m', $ts2);

    $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
    return $diff;
}


function format_indo($date)
{
    date_default_timezone_set('Asia/Jakarta');
    // array hari dan bulan
    $Hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
    $Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    // pemisahan tahun, bulan, hari, dan waktu
    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl = substr($date, 8, 2);
    $waktu = substr($date, 11, 5);
    $hari = date("w", strtotime($date));
    $result = $Hari[$hari] . ", " . $tgl . " " . $Bulan[(int)$bulan - 1] . " " . $tahun . " " . $waktu;

    return $result;
}


function aos_default($slide, $duration, $delay)
{
    $tag = 'data-aos="' . $slide . '" data-aos-duration="' . $duration . '" data-aos-delay="' . $delay . '"';
    return $tag;
}
