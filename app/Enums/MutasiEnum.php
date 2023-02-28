<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class MutasiEnum extends Enum
{
    const TIDAK = 'Tidak';
    const KELAHIRAN = 'Kelahiran';
    const KEMATIAN = 'Kematian';
    const PINDAHDATANG = 'Pindah Datang';
    const PINDAHMASUK = 'Pindah Masuk';
}
