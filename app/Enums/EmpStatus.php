<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class EmpStatus extends Enum
{
    const FULLTIME =   0;
    const TEMP =   1;
    const CONTRACT = 2;
    const OUTSOURCING = 3;
    const PARTTIME = 4;
    const COMMISSIONED = 5;
    const OTHERS = 6;

    public static function getDescription($value): string
    {
        if ($value === self::FULLTIME) {
            return '正社員';
        }

        if ($value === self::TEMP) {
            return '派遣社員';
        }

        if ($value === self::CONTRACT) {
            return '契約社員';
        }

        if ($value === self::OUTSOURCING) {
            return '業務委託';
        }

        if ($value === self::PARTTIME) {
            return 'アルバイト・パート';
        }
        if ($value === self::COMMISSIONED) {
            return '嘱託';
        }
        if ($value === self::OTHERS) {
            return 'その他';
        }

        return parent::getDescription($value);
    }

    public static function getValue(string $key)
    {
        if ($key === '正社員') {
            return self::FULLTIME;
        }

        if ($key === '派遣社員') {
            return self::TEMP;
        }

        if ($key === '契約社員') {
            return self::CONTRACT;
        }

        if ($key === '業務委託') {
            return self::OUTSOURCING;
        }

        if ($key === 'アルバイト・パート') {
            return self::PARTTIME;
        }

        if ($key === '嘱託') {
            return self::COMMISSIONED;
        }

        if ($key === 'その他') {
            return self::OTHERS;
        }

        return parent::getValue($key);
    }
}
