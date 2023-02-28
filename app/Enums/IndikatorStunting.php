<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class IndikatorStunting extends Enum
{
    const indikator_1 = 'Ada Balita';
    const indikator_2 = 'Tidak ada anggota keluarga memilki penghasilan untuk memenuhi kebutuhan';
    const indikator_3 = 'Jenis lantai tanah';
    const indikator_4 = 'Tidak setiap anggota keluarga makan makanan beragam paling sedikit 2x sehari';
    const indikator_5 = 'Keluarga tidak mempunyai sumber minum utama yang layak';
    const indikator_6 = 'Tidak mempunyai jamban yang layak';
    const indikator_7 = 'Tidak mempunyai rumah yang layak huni';
    const indikator_8 = 'Pendidikan terakhir ibu dibawah SLTP';
    const indikator_9 = 'Umur istri terlalu muda (kurang dari 20 th)';
    const indikator_10 = 'Terlalu tua (Umur istri lebih dari 35 th)';
    const indikator_11 = 'Terlalu dekat (Jarak anak kurang dari 2 th)';
    const indikator_12 = 'Terlalu banyak anak lebih dari 3';
}
