<?php

namespace Paysera\Bundle\RestBundle\Entity;

class ErrorConfig
{
    protected $config;

    public function __construct()
    {
        $this->config = [];
    }

    /**
     * Sets error config by code
     *
     * @param string $code
     * @param int $statusCode
     * @param string $message
     * @param string $uri
     */
    public function configure($code, $statusCode = null, $message = null, $uri = null)
    {
        $this->config[$code] = [
            'statusCode' => $statusCode,
            'message' => $message,
            'uri' => $uri,
        ];
    }

    public function mergeWith(ErrorConfig $errorConfig)
    {
        $this->config += $errorConfig->config;
    }

    public function getConfig($code)
    {
        return isset($this->config[$code]) ? $this->config[$code] : null;
    }
}
