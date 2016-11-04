Brofist Configuration
-----------------

Handles merging of configurations

Code information:

[![Build Status](https://travis-ci.org/brofist-team/configuration.png?branch=master)](https://travis-ci.org/brofist-team/configuration)
[![Coverage Status](https://coveralls.io/repos/brofist-team/configuration/badge.png?branch=master)](https://coveralls.io/r/brofist-team/configuration?branch=master)
[![Code Coverage Scrutinizer](https://scrutinizer-ci.com/g/brofist-team/configuration/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/brofist-team/configuration/?branch=master)
[![Code Climate](https://codeclimate.com/github/brofist-team/configuration/badges/gpa.svg)](https://codeclimate.com/github/brofist-team/configuration)
[![Issue Count](https://codeclimate.com/github/brofist-team/configuration/badges/issue_count.svg)](https://codeclimate.com/github/brofist-team/configuration)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/brofist-team/configuration/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/brofist-team/configuration/?branch=master)
[![StyleCI](https://styleci.io/repos/72840944/shield)](https://styleci.io/repos/72840944)

Package information:

[![Latest Stable Version](https://poser.pugx.org/brofist/configuration/v/stable)](https://packagist.org/packages/brofist/configuration)
[![Total Downloads](https://poser.pugx.org/brofist/configuration/downloads)](https://packagist.org/packages/brofist/configuration)
[![Latest Unstable Version](https://poser.pugx.org/brofist/configuration/v/unstable.svg)](https://packagist.org/packages/brofist/configuration)
[![License](https://poser.pugx.org/brofist/configuration/license)](https://packagist.org/packages/brofist/configuration)
[![Dependency Status](https://gemnasium.com/badges/github.com/brofist-team/configuration.svg)](https://gemnasium.com/github.com/brofist-team/configuration)
[![composer.lock](https://poser.pugx.org/brofist/configuration/composerlock)](https://packagist.org/packages/brofist/configuration)

## Usage


```php
<?php

use Brofist\Configuration\Configuration;

$development = new Configuration([
    'env'   => 'development',
    'admin' => [
        'name'       => 'John',
        'middleName' => 'Some Middle Name',
    ],
]);

$production = new Configuration([
    'env'   => 'production',
    'admin' => [
        'name'     => 'Other Name',
        'lastName' => 'John',
    ],
]);

$application = $development->merge($production);

$application->toArray();

// will return

[
    // replaces when it is not an array
    'env'   => 'production',

    // merges when it is an array, replacing when necessary
    'admin' => [
        'name'       => 'Other Name',
        'middleName' => 'Some Middle Name',
        'lastName'   => 'John',
    ],
];
```

## Installing

```bash
composer require brofist/configuration
```

## Issues/Features proposals

[Here](https://github.com/brofist-team/configuration/issues) is the issue tracker.

## Lincense

[MIT](MIT-LICENSE)

## Authors

- [Brofist](https://github.com/brofist-team)
