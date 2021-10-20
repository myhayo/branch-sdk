<?php

namespace Myhayo\Branch\Exceptions;

class EmptyUuidException extends Exception
{
    /**
     * Bootstrap.
     *
     * @param string $message
     *
     * @author yansongda <me@yansonga.cn>
     *
     */
    public function __construct($message = '')
    {
        parent::__construct($message ?: 'EMPTY_UUID', self::EMPTY_UUID);
    }
}
