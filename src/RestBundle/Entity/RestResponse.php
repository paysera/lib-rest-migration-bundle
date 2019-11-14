<?php

namespace Paysera\Bundle\RestBundle\Entity;

class RestResponse
{
    /**
     * @var mixed
     */
    protected $response;

    /**
     * @var array
     */
    protected $headers;

    /**
     * @var array
     */
    protected $options;

    /**
     * Constructs object
     *
     * @param mixed $response
     * @param array $headers
     */
    public function __construct($response, $headers = [])
    {
        $this->setResponse($response);
        $this->setHeaders($headers);
        $this->headers = [];
        $this->options = [];
    }

    /**
     * @param mixed $response
     *
     * @return static
     */
    public static function create($response)
    {
        return new static($response);
    }

    /**
     * Gets response
     *
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Sets response
     *
     * @param mixed $response
     * @return $this
     */
    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * Gets headers
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Sets headers
     *
     * @param array $headers
     * @return $this
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * Adds header
     *
     * @param string $header
     * @return $this
     */
    public function addHeader($header)
    {
        $this->headers[] = $header;
        return $this;
    }

    /**
     * Sets options
     *
     * @param array $options
     *
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Sets options
     *
     * @param string $key
     * @param mixed $value
     *
     * @return $this
     */
    public function setOption($key, $value)
    {
        $this->options[$key] = $value;

        return $this;
    }

    /**
     * Gets options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }
}
