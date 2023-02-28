<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StatusPernikahan extends Enum
{
    const JANDA = 'Janda';
    const BELUM = 'Belum Menikah';
    const MENIKAH = 'MENIKAH';
}
