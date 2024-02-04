# CerebralFart/Hydrate
_Load data into classes_

## Getting started
Getting started is easy, just install the package and start hydrating data:
```shell
composer require cerebralfart/hydrate
```

```php
$data = [...];
$structure = Hydrate::load($data, Model::class);
```

## Roadmap
### 0.1.0
- Load nested objects
- Load array properties
