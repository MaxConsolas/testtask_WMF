<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class INN implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     * Проверка на валидность ИНН
     * Без оптимизаций и сокращений. Для наглядности.
     *
     * @param  string  $attribute
     * @param  mixed  $v
     * @return bool
     */
    public function passes($attribute, $v)
    {
        // Если 10 знаков
        if (strlen($v) == 10) {

            $step1 = $v[0] * 2 + $v[1] * 4 + $v[2] * 10 + $v[3] * 3 + $v[4] * 5 + $v[5] * 9 + $v[6] * 4 + $v[7] * 6 + $v[8] * 8 + $v[9] * 0;
            $step2 = $step1 % 11;
            $step3 = ($step2 > 9) ? $step2 % 10 : $step2;
            $step4 = ($step3 == $v[9]);

            return $step4;
        }

        // Если 12 знаков
        if (strlen($v) == 12) {

            $step1 = $v[0] * 7 + $v[1] * 2 + $v[2] * 4 + $v[3] * 10 + $v[4] * 3 + $v[5] * 5 + $v[6] * 9 + $v[7] * 4 + $v[8] * 6 + $v[9] * 8 + $v[10] * 0;
            $step2 = $step1 % 11;
            $step3 = $step2 > 9 ? $step2 % 10 : $step2;
            $step4 = $v[0] * 3 + $v[1] * 7 + $v[2] * 2 + $v[3] * 4 + $v[4] * 10 + $v[5] * 3 + $v[6] * 5 + $v[7] * 9 + $v[8] * 4 + $v[9] * 6 + $v[10] * 8 + $v[11] * 0;
            $step5 = $step4 % 11;
            $step6 = $step5 > 9 ? $step5 % 10 : $step5;
            $step7 = ($step3 == $v[10] && $step6 == $v[11]);

            return $step7;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Некорректный ИНН';
    }
}
