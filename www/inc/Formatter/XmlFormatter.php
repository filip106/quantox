<?php

namespace inc\Formatter;

use SimpleXMLElement;

/**
 * Class XmlFormatter
 * @package inc\Formatter
 */
class XmlFormatter extends Formatter
{
    /** @var XmlFormatter */
    private static $instance;

    /** @var string */
    private $rootElement = 'student';

    private function __construct()
    {
    }

    /**
     * @return XmlFormatter
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new XmlFormatter();
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
        header("Content-type: text/xml; charset=utf-8");
        $xmlData = new SimpleXMLElement(sprintf('<?xml version="1.0"?><%s></%s>', $this->rootElement, $this->rootElement));
        $this->arrayToXml($response, $xmlData);

        return $xmlData->asXML();
    }

    /**
     * @param array $data
     * @param SimpleXMLElement $xmlData
     */
    private function arrayToXml($data, &$xmlData)
    {
        foreach ($data as $key => $value) {
            if (is_numeric($key)) {
                $key = 'item' . $key;
            }
            if (is_array($value)) {
                $subnode = $xmlData->addChild($key);
                $this->arrayToXml($value, $subnode);
            } else {
                $xmlData->addChild("$key", htmlspecialchars("$value"));
            }
        }
    }
}