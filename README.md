## Extensi Peta Untuk Ezadev Admin

```
composer require ezadev/peta -vvv
```

Konfig:

```
config/admin.php

'extensions' => [

        'peta' => [
            'enable' => true,
            'default' => 'google',
            'providers' => [
                'google' => [
                    'api_key' => '',
                ]
            ]
        ]
    ]
```

Usaga Di Form

```
$form->peta('latitude', 'longitude', 'Position');

// Set the map height
$form->peta('latitude', 'longitude', 'Position')->height(500);

// Set default position
$form->peta('latitude', 'longitude', 'Position')->default(['lat' => 90, 'lng' => 90]);
```

Usage di Show

```
$show->field('Position')->peta('lat_column', 'long_column', $height = 400);
```