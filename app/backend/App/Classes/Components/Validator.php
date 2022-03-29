<?php

namespace App\Classes\Components;

class Validator
{
    private array $data;

    /**
     * Validator constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param $code
     * @return mixed
     */
    public static function flashMessage($code)
    {
        if (!empty($_SESSION["form_validation"][$code])) {
            $validationMessage = $_SESSION["form_validation"][$code];
            unset($_SESSION["form_validation"][$code]);

            return $validationMessage;
        }
    }

    /**
     * @param string $inputName
     * @param string $code
     * @param string $message
     */
    public function isRequired(string $inputName, string $code, string $message)
    {
        if (strlen($this->data[$inputName]) === 0) {
            $_SESSION["form_validation"][$code] = $message;
        }
    }

    /**
     * @param string $inputName
     * @param string $code
     * @param string $message
     */
    public function isAlphaNumeric(string $inputName, string $code, string $message)
    {
        if (!preg_match("#\w+#", $this->data[$inputName])) {
            $_SESSION["form_validation"][$code] = $message;
        }
    }

    /**
     * @return bool
     */
    public function isFailed(): bool
    {
        return !empty($_SESSION["form_validation"]);
    }
}