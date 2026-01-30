<?php

declare(strict_types=1);

namespace Gaur\HTTP;

class Request
{
    /**
     * Method of encode
     *
     * @var string
     */
    protected string $encode;

    /**
     * Data list
     *
     * @var array<string, string|string[]>
     */
    protected array $data;

    /**
     * Headers list
     *
     * @var array<string, string|string>
     */
    protected array $headers;

    /**
     * Curl options
     *
     * @var mixed[]
     */
    protected array $options;

    /**
     * Request method
     *
     * @var string
     */
    protected string $method;

    /**
     * Request url
     *
     * @var string
     */
    protected string $url;

    /**
     * Encode data list to uri
     *
     * @param array<string, string|string[]> $data data list to encode
     *
     * @return string
     */
    protected function encodeUri(array $data): string
    {
        $uri = [];

        foreach ($data as $k => $item) {
            if (is_array($item)) {
                foreach ($item as $i => $v) {
                    $uri[] = urlencode((string)$k) . '[' . $i . ']' . '=' . urlencode((string)$v);
                }
            } else {
                $uri[] = urlencode((string)$k) . '=' . urlencode((string)$item);
            }
        }

        return implode('&', $uri);
    }

    /**
     * Encode headers list
     *
     * @param array<string, string> $headers headers list to encode
     *
     * @return string[]
     */
    protected function encodeHeaders(array $headers): array
    {
        $eheaders = [];

        foreach ($headers as $k => $v) {
            $eheaders[] = $k . ': ' . $v;
        }

        return $eheaders;
    }

    /**
     * Set options
     *
     * @return void
     */
    protected function setOptions(): void
    {
        switch ($this->method) {
            case 'GET':
                $this->options[CURLOPT_HTTPGET] = true;

                if (!$this->data) {
                    break;
                }

                if (is_int(strpos($this->url, '?'))) {
                    $this->url .= '&';
                } else {
                    $this->url .= '?';
                }

                $this->url .= $this->encodeUri($this->data);
                break;

            case 'POST':
                $this->options[CURLOPT_POST] = true;

                if (!$this->data) {
                    break;
                }

                if ($this->encode === 'json') {
                    $this->options[CURLOPT_POSTFIELDS] = json_encode($this->data);
                } else {
                    $this->options[CURLOPT_POSTFIELDS] = $this->encodeUri($this->data);
                }

                break;
        }

        if ($this->headers) {
            $this->options[CURLOPT_HTTPHEADER] = $this->encodeHeaders($this->headers);
        }

        $this->options[CURLOPT_URL] = $this->url;
    }

    /**
     * Load initial values
     *
     * @param string $method request method
     * @param string $url    request url
     * @param string $encode method of encode
     *
     * @return void
     */
    public function __construct(string $method, string $url, string $encode = '')
    {
        $options = [
            // force libcurl to ignore previously stored sessions cookies
            CURLOPT_COOKIESESSION => true,

            // disable ssl verification
            // CURLOPT_SSL_VERIFYHOST  => 0,
            // CURLOPT_SSL_VERIFYPEER  => FALSE,

            // An array of HTTP header
            // CURLOPT_HTTPHEADER => []

            // The contents of the "Referer: " header
            // CURLOPT_REFERER => '',

            // The contents of the "User-Agent: " header
            // CURLOPT_USERAGENT => '',

            // The URL to fetch
            // CURLOPT_URL => '',

            // reset the HTTP request method to GET
            // CURLOPT_HTTPGET => true,

            // reset the HTTP request method to POST application/x-www-form-urlencoded
            // CURLOPT_POST => true,

            // data to post, parameter can either urlencoded string or array
            // If value is an array, the Content-Type header will be set to multipart/form-data
            // CURLOPT_POSTFIELDS => '',

            // the number of seconds to wait while trying to connect
            CURLOPT_CONNECTTIMEOUT => 120,

            // the maximum number of seconds to allow cURL functions to execute
            CURLOPT_TIMEOUT => 120,

            // follow any "Location: " header
            CURLOPT_FOLLOWLOCATION => true,

            // the maximum amount of HTTP redirections to follow
            CURLOPT_MAXREDIRS => 2,

            // handle all encodings
            CURLOPT_ENCODING => '',

            // include the header in the output
            CURLOPT_HEADER => false,

            // get the raw HTTP response body
            // CURLOPT_HTTP_CONTENT_DECODING => false,

            // return the transfer as a string
            CURLOPT_RETURNTRANSFER => true,
        ];

        $this->encode  = $encode;
        $this->data    = [];
        $this->headers = [];
        $this->options = $options;

        $this->method = strtoupper($method);
        $this->url    = $url;
    }

    /**
     * Set data list
     *
     * @param array<string, string|string[]> $data data list
     *
     * @return self
     */
    public function data(array $data): self
    {
        foreach ($data as $k => $v) {
            $this->data[$k] = $v;
        }

        return $this;
    }

    /**
     * Set headers list
     *
     * @param array<string, string> $headers headers list
     *
     * @return self
     */
    public function headers(array $headers): self
    {
        foreach ($headers as $k => $v) {
            $this->headers[$k] = $v;
        }

        return $this;
    }

    /**
     * Create new request
     *
     * @return mixed[]|null
     */
    public function send(): ?array
    {
        $curl = curl_init();

        $this->setOptions();

        if (!curl_setopt_array($curl, $this->options)) {
            return null;
        }

        $response = curl_exec($curl);
        $info     = curl_getinfo($curl);

        $output = [
            'status'    => $info['http_code'],
            'size'      => $info['size_download'],
            'response'  => $response,
            'error'     => curl_error($curl)
        ];

        // file_put_contents(__DIR__ . '/' . time(), json_encode($output));

        curl_close($curl);

        return $output;
    }
}
