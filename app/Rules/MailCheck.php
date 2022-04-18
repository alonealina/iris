<?php

namespace App\Rules;

use App\Models\Application;
use Illuminate\Contracts\Validation\Rule;
class MailCheck implements Rule
{
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $count = Application::where('mail', $value)->where('delete_flg', 0)->count();
        if ($count > 0) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '同じメールアドレスが登録されています';
    }
}
