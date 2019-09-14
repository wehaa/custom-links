# Add custom links to your nova navigation

This tool allows you to add a custom links as a section in your sidebar or a single top level link.

## Installation

You can install the package in to a Laravel app that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require wehaa/custom-links
```

Then you must register the tool with Nova. This is typically done in the `tools` method of the `NovaServiceProvider`.

```php
// in app/Providers/NovaServiceProvider.php

use Wehaa\CustomLinks\CustomLinks;

// ...

public function tools()
{
    return [
        // ...
        new CustomLinks(),
    ];
}
```

To publish the config file to `config/custom-links.php` run:

```bash
php artisan vendor:publish --provider="Wehaa\CustomLinks\ToolServiceProvider"
```

To add links to the navigation section you need to add entries to the `links` section in the config file.

```php
return [
    'links' => [
        '{TEXT}' => [                           // Top level section title text
            '_can'    => '{PERMISSION}'         // The name of the permission
            '_icon'   => '{ICON}',              // SVG icon code (optional)
            '_url'    => '{URL}',               // URL (optional if _links is present)
            '_target' => '{TARGET}',            // Link target (optional) 
            '_links'  => [                      // Section extra links (optional if _url is present
                '{TEXT}' => [                   // Sub section text
                    '_can'    => '{PERMISSION}' // The name of the permission
                    '_url'    => '{URL}',       // URL
                    '_target' => '{TARGET}',    // Link target (optional)
                ]
            ]
        ]
    ]
];

```

The included config file will add some links you can use as an example. 

## Authorization

If you would like to only expose your links to certain users, you may chain the `canSee` method onto your tool's registration.

```php
// in app/Providers/NovaServiceProvider.php

use Wehaa\CustomLinks\CustomLinks;

// ...

public function tools()
{
    return [
        // ...
        (new CustomLinks)->canSee(function ($request) {
            return false;
        }),
    ];
}
```

In addition, you can add the key `_can` in the links array, including the child links as well. We will use the `can()` function to check if the user has the permission to see the links or not.

Please note that if you don't want any authorization checks, do not add the `_can` key.

```php
return [
    'links' => [
        '{TEXT}' => [                           // Top level section title text
            '_can'    => '{PERMISSION}'         // Checks if the link and sublinks can be shown
            // ...
            '_links'  => [                      // Section extra links (optional if _url is present
                '{TEXT}' => [                   // Sub section text
                    '_can'    => '{PERMISSION}' // Checks if the link can be shown
                    // ...
                ]
            ]
        ]
    ]
];
```