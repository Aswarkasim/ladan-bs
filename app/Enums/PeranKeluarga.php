<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PeranKeluarga extends Enum
{
    const KEPALA_KELUARGA = 'Kepala Keluarga';
    const ISTRI = 'Istri';
    const ANGGOTA = 'Anggota';
}
