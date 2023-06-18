<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RegexPhone implements Rule
{
    protected $errorType;

    protected const ERROR_TYPE_FORMAT = 1;
    protected const ERROR_TYPE_NUMERIC = 2;
    protected const ERROR_TYPE_LENGTH = 3;
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
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!preg_match('/^[0-9]+$/', $value)) {
            $this->errorType = self::ERROR_TYPE_NUMERIC;
            return false;
        }

        $phoneLength = strlen($value);
        if ($phoneLength < 10 || $phoneLength > 11) {
            $this->errorType = self::ERROR_TYPE_LENGTH;
            return false;
        }

        if ($phoneLength === 10 && !preg_match('/^(032|033|034|035|036|037|038|039|086|096|097|098|081|082|083|084|085|088|091|094|056|058|092|070|076|077|078|079|089|090|093|099|059)+([0-9]{7})$/', $value)) {
            $this->errorType = self::ERROR_TYPE_FORMAT;
            return false;
        }

        // return preg_match('/(84|0[3|5|7|8|9])+([0-9]{8})\b/', $value);
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        switch ($this->errorType) {
            case self::ERROR_TYPE_NUMERIC:
                $msg = 'Điện thoại phải là chữ số';
                break;
            case self::ERROR_TYPE_LENGTH:
                $msg = 'Điện thoại phải có độ dài 10 số';
                break;
            default:
                $msg = 'Số điện thoại không đúng định dạng';
                break;
        }
        return $msg;
        // return 'Phone number is not in the correct format.';
    }
}
