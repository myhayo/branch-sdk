<?php

namespace Myhayo\Branch\Exceptions;

class Exception extends \Exception
{
    const UNKNOWN_ERROR = 9999;

    const INVALID_ACCESS = 1;
    const EMPTY_UUID = 2;
    const INVALID_DEVICE_ACTION = 3;

    /**
     * Bootstrap.
     *
     * @param string       $message
     * @param array|string $raw
     * @param int|string   $code
     *
     * @author yansongda <me@yansonga.cn>
     *
     */
    public function __construct($message = '', $raw = [], $code = self::UNKNOWN_ERROR)
    {
        $message = '' === $message ? 'Unknown Error' : $message;

        parent::__construct($message, intval($code));
    }
}
