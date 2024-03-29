<?php

namespace Ezadev\Admin\Peta;

use Ezadev\Admin\Admin;
use Ezadev\Admin\Extension as BaseExtension;

class Extension extends BaseExtension
{
    public $name = 'peta';

    public $views = __DIR__.'/../resources/views';

    /**
     * @var array
     */
    protected static $providers = [
        'google'  => Map\Google::class,
    ];

    /**
     * @var Map\AbstractMap
     */
    protected static $provider;

    /**
     * @param string $name
     * @return Map\AbstractMap
     */
    public static function getProvider($name = '')
    {
        if (static::$provider) {
            return static::$provider;
        }

        $name = Extension::config('default', $name);
        $args = Extension::config("providers.$name", []);

        return static::$provider = new static::$providers[$name](...array_values($args));
    }

    /**
     * @return \Closure
     */
    public static function showField()
    {
        return function ($lat, $lng, $height = 300) {

            return $this->unescape()->as(function () use ($lat, $lng, $height) {

                $lat = $this->{$lat};
                $lng = $this->{$lng};

                $id = ['lat' => 'lat', 'lng' => 'lng'];

                Admin::script(Extension::getProvider()->applyScript($id));

                return <<<HTML
<div class="row">
    <div class="col-md-3">
        <input id="{$id['lat']}" class="form-control" value="{$lat}"/>
    </div>
    <div class="col-md-3">
        <input id="{$id['lng']}" class="form-control" value="{$lng}"/>
    </div>
</div>

<br>

<div id="map_{$id['lat']}{$id['lng']}" style="width: 100%;height: {$height}px"></div>
HTML;
            });
        };
    }
}