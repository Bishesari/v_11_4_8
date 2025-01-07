<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NCode implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (strlen($value) != 10) {
            $fail('تعداد رقمهای :attribute باید 10 باشد.');
        } else {
            $sum = 0;
            $j = 10;
            for ($i = 0; $i < 9; $i++) {
                $sum += intval($value[$i]) * $j;
                $j--;
            }
            $remain = $sum % 11;
            if ($remain < 2) {
                if ($remain != intval($value[9])) {
                    $fail(':attribute اعتبار ندارد.');
                }
            } else {
                if ((11 - $remain) != intval($value[9])) {
                    $fail(':attribute اعتبار ندارد.');
                }
            }
        }
    }
}
