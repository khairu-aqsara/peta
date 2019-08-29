<?php

namespace Ezadev\Admin\Peta;

use Ezadev\Admin\Admin;
use Ezadev\Admin\Form;
use Ezadev\Admin\Show;
use Illuminate\Support\ServiceProvider;

class PetaServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(Extension $extension)
    {
        if (! Extension::boot()) {
            return ;
        }

        $this->loadViewsFrom($extension->views(), 'ezadev-peta');

        Admin::booting(function () {
            Form::extend('latlong', Latlong::class);
            Show\Field::macro('latlong', Extension::showField());
        });
    }
}