<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class RoleEnum extends Enum
{
    const SUPERADMIN = 'Superadmin';
    const ADMIN = 'Admin';
    const KECAMATAN = 'Kecamatan';
    const DESA = 'Desa';
    const DUSUN = 'Dusun';
}
