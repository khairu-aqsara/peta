<?php

namespace Ezadev\Admin\Peta;

use Ezadev\Admin\Form\Field;

class Peta extends Field
{
    /**
     * Set to true to automatically get the current position from the browser
     * @var bool
     */
    protected $autoPosition = false;
    protected $fieldAddress = false;
    /**
     * Column name.
     *
     * @var array
     */
    protected $column = [];

    /**
     * @var string
     */
    protected $view = 'ezadev-peta::peta';

    /**
     * Map height.
     *
     * @var int
     */
    protected $height = 200;

    /**
     * Get assets required by this field.
     *
     * @return array
     */
    public static function getAssets()
    {
        return ['js' => Extension::getProvider()->getAssets()];
    }

    /**
     * Latlong constructor.
     *
     * @param string $column
     * @param array $arguments
     */
    public function __construct($column, $arguments)
    {
        $this->column['lat'] = (string)$column;
        $this->column['lng'] = (string)$arguments[0];

        array_shift($arguments);

        $this->label = $this->formatLabel($arguments);
        $this->id    = $this->formatId($this->column);
    }

    /**
     * Set map height.
     *
     * @param int $height
     * @return $this
     */
    public function height(int $height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Set true to automatically get the current position from the browser on page load
     * @param $bool
     * @return Latlong
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
     * {@inheritdoc}
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function render()
    {
        $this->script = Extension::getProvider()
              ->setFieldAddress($this->fieldAddress)
              ->setAutoPosition($this->autoPosition)->applyScript($this->id);

        $variables = [
            'height'   => $this->height,
            'provider' => Extension::config('default'),
        ];

        return parent::render()->with($variables);
    }
}
