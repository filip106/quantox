<?php

namespace inc\Formatter;

/**
 * Class JsonFormatter
 * @package inc\Formatter
 */
class JsonFormatter extends Formatter
{
    /** @var JsonFormatter */
    private static $instance;

    private function __construct()
    {
    }

    /**
     * @return JsonFormatter
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new JsonFormatter();
        }

        return self::$instance;
    }

    /**
     * @param array $response
     *
     * @return mixed
     */
    public function formatResult($response)
    {
        return json_encode($response);
    }
}