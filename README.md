# Pathman

Pathman is a PHP 5.3+ simple directory management system for Laravel 4.

## Installation

To install through composer, simply put the following in your `composer.json` file:

```json
{
	"require-dev": {
		"ahir/pathman": "dev-master"
	}
}
```

### Usage

After installing the package, open your Laravel config file app/config/app.php and add the following lines.

In the $providers array add the following service provider for this package.

```php
	'Ahir\Pathman\PathmanServiceProvider',
```


