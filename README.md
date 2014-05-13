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
### Configuration

Library has got two different configuration parameters.

* `hashing`: This parameter is using with time folders method. You can choose "false" value or any php hashing algorithm. (md5, adler32 etc.)

* `time-pattern`: This parameter is setting time folders structure.

### Examples

##### Create Folder and Set Writable

```php	
try {
	Pathman::set('new-folder-name');
} catch (Exception $e) {
	echo $e->getMessage();
}
```

##### Create Time Folders By Root


```php
try {
	$path = Pathman::timeFolders('root-folder');
} catch (Exception $e) {
	echo $e->getMessage();
}

// root-folder/2014/05/12/18/56
echo $path;
```
