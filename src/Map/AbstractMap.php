<?php

namespace Ezadev\Admin\Peta\Map;


abstract class AbstractMap
{
    /**
     * Set to true to automatically get the current position from the browser
     * @var bool
     */
    protected $autoPosition = false;
    protected $fieldAddress = false;

    /**
     * @var string
     */
    protected $api;

    /**
     * Tencent constructor.
     * @param $key
     */
    public function __construct($key = '')
    {
        if ($key) {
            $this->api = sprintf($this->api, $key);
        }
    }

    /**
     * @return array
     */
    public function getAssets()
    {
        return [$this->api];
    }

    /**
     * Set true to automatically get the current position from the browser on page load
     * @param $bool
     * @return $this
     */
    public function setAutoPosition($bool) {
        $this->autoPosition = $bool;
        return $this;
    }

    /**
     * Set Auocomplete name to Address Field if any
     * @param $string
     * @return Place form Google Map Address
     */

    public function setFieldAddress($string)
    {
      $this->fieldAddress = $string;
      return $this;
    }

    /**
     * @param array $id
     * @param bool $autoPosition
     * @return string
     */
    abstract public function applyScript(array $id);
}
