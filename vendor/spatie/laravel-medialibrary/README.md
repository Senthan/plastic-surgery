# Associate files with Eloquent models

[![Latest Version](https://img.shields.io/github/release/spatie/laravel-medialibrary.svg?style=flat-square)](https://github.com/spatie/laravel-medialibrary/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/spatie/laravel-medialibrary/master.svg?style=flat-square)](https://travis-ci.org/spatie/laravel-medialibrary)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/27cf455a-0555-4bcf-abae-16b5f7860d09.svg?style=flat-square)](https://insight.sensiolabs.com/projects/27cf455a-0555-4bcf-abae-16b5f7860d09)
[![Quality Score](https://img.shields.io/scrutinizer/g/spatie/laravel-medialibrary.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie/laravel-medialibrary)
[![StyleCI](https://styleci.io/repos/33916850/shield)](https://styleci.io/repos/33916850)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-medialibrary.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-medialibrary)

This Laravel >=5.1 and Lumen compatible package can associate all sorts of files with Eloquent models. It provides a
simple API to work with. To learn all about it, head over to [the extensive documention](https://docs.spatie.be/laravel-medialibrary/v4). 

Here are a few short examples of what you can do:
```php
$newsItem = News::find(1);
$newsItem->addMedia($pathToFile)->toCollection('images');
```
It can handle your uploads directly:
```php
$newsItem->addMedia($request->file('image'))->toCollection('images');
```
Want to store some large files on another filesystem? No problem:
```php
$newsItem->addMedia($smallFile)->toCollectionOnDisk('downloads', 'local');
$newsItem->addMedia($bigFile)->toCollectionOnDisk('downloads', 's3');
```
The storage of the files is handled by [Laravel's Filesystem](http://laravel.com/docs/5.1/filesystem),
so you can use any filesystem you like. Additionally the package can create image manipulations
on images and pdfs that have been added in the medialibrary.

Spatie is a webdesign agency in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

## Documentation
You'll find the documentation on [https://docs.spatie.be/laravel-medialibrary/v4](https://docs.spatie.be/laravel-medialibrary/v4).

Find yourself stuck using the package? Found a bug? Do you have general questions or suggestions for improving the media library? Feel free to [create an issue on GitHub](https://github.com/spatie/laravel-medialibrary/issues), we'll try to address it as soon as possible.

If you've found a bug regarding security please mail [freek@spatie.be](mailto:freek@spatie.be) instead of using the issue tracker.

## Requirements
To create derived images [GD](http://php.net/manual/en/book.image.php) should be installed on your server.
For the creation of thumbnails of svg's or pdf's you should also install [Imagick](http://php.net/manual/en/imagick.setresolution.php).

## Postcardware

You're free to use this package (it's [MIT-licensed](LICENSE.md)), but if it makes it to your production environment you are required to send us a postcard from your hometown, mentioning which of our package(s) you are using.

Our address is: Spatie, Samberstraat 69D, 2060 Antwerp, Belgium.

The best postcards will get published on the open source page on our website.

## Installation

You can install this package via composer using this command:

```bash
composer require spatie/laravel-medialibrary:^4.0.0
```

Next, you must install the service provider:

```php
// config/app.php
'providers' => [
    ...
    Spatie\MediaLibrary\MediaLibraryServiceProvider::class,
];
```

You can publish the migration with:
```bash
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="migrations"
```

After the migration has been published you can create the media-table by running the migrations:

```bash
php artisan migrate
```

You can publish the config-file with:
```bash
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [

    /*
     * The filesystems on which to store added files and derived images by default. Choose
     * one or more of the filesystems you configured in app/config/filesystems.php
     */
    'defaultFilesystem' => 'media',

    /*
     * The maximum file size of an item in bytes. Adding a file
     * that is larger will result in an exception.
     */
    'max_file_size' => 1024 * 1024 * 10,

    /*
     * This queue will be used to generate derived images.
     * Leave empty to use the default queue.
     */
    'queue_name' => '',

    /*
     * The class name of the media model to be used.
     */
    'media_model' => Spatie\MediaLibrary\Media::class,

    /*
     * When urls to files get generated this class will be called. Leave empty
     * if your files are stored locally above the site root or on s3.
     */
    'custom_url_generator_class' => null,

    /*
     * The class that contains the strategy for determining a media file's path.
     */
    'custom_path_generator_class' => null,

    's3' => [
        /*
         * The domain that should be prepended when generating urls.
         */
        'domain' => 'https://xxxxxxx.s3.amazonaws.com',
    ],

    'remote' => [
        /*
         * Any extra headers that should be included when uploading media to
         * a remote disk. Even though supported headers may vary between
         * different drivers, a sensible default has been provided.
         *
         * Supported by S3: CacheControl, Expires, StorageClass,
         * ServerSideEncryption, Metadata, ACL, ContentEncoding
         */
        'extra_headers' => [
            'CacheControl' => 'max-age=604800',
        ],
    ],

    /*
     * FFMPEG & FFProbe binaries path, only used if you try to generate video
     * thumbnails and have installed the php-ffmpeg/php-ffmpeg composer
     * dependency.
     */
    'ffmpeg_binaries' => '/usr/bin/ffmpeg',
    'ffprobe_binaries' => '/usr/bin/ffprobe',
];

```

And finally you should add a disk to `app/config/filesystems.php`. This would be a typical configuration:

```php
    ...
	'disks' => [
	    ...
	    
        'media' => [
            'driver' => 'local',
            'root'   => public_path().'/media',
        ],
    ...    
```

All files of the medialibrary will be stored on that disk. If you are planning on
working with the image manipulations you should configure a queue on your service
with the name specified in the config file.

## Lumen Support
Lumen configuration is slightly more involved but features and API are identical to Laravel.

Install using this command:
```bash
composer require spatie/laravel-medialibrary
```

Uncomment the following lines in the bootstrap file:
```php
// bootstrap/app.php:
$app->withFacades();
$app->withEloquent();
```

Configure the laravel-medialibrary service provider (and `AppServiceProvider` if not already enabled):
```php
// bootstrap/app.php:
$app->register(App\Providers\AppServiceProvider::class);
$app->register(Spatie\MediaLibrary\MediaLibraryServiceProvider::class);
```

Update the `AppServiceProvider` register method to bind the filesystem manager to the IOC container:
```php
// app/Providers/AppServiceProvider.php
public function register()
{
    $this->app->singleton('filesystem', function ($app) {
        return $app->loadComponent('filesystems', 'Illuminate\Filesystem\FilesystemServiceProvider', 'filesystem');
    });

    $this->app->bind('Illuminate\Contracts\Filesystem\Factory', function($app) {
        return new \Illuminate\Filesystem\FilesystemManager($app);
    });
}
```

Manually copy the package config file to `app\config\laravel-medialibrary.php` (you may need to
create the config directory if it does not already exist).

Copy the [Laravel filesystem config file](https://github.com/laravel/laravel/blob/v5.2.31/config/filesystems.php) into `app\config\filesystem.php`. You should add a disk configuration to the filesystem config matching the `defaultFilesystem` specified in the laravel-medialibrary config file.

Finally, update `boostrap/app.php` to load both config files:

```php
// bootstrap/app.php
$app->configure('laravel-medialibrary');
$app->configure('filesystems');
```

## Testing

You can run the tests with:

```bash
vendor/bin/phpunit
```
##Upgrading

Please see [UPGRADING](UPGRADING.md) for details.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email [freek@spatie.be](mailto:freek@spatie.be) instead of using the issue tracker.

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

A big thank you to [Nicolas Beauvais](https://github.com/nicolasbeauvais) for helping out with the issues on this repo.

## Alternatives
- [laravel-mediable](https://github.com/plank/laravel-mediable)
- [laravel-stapler](https://github.com/CodeSleeve/laravel-stapler)
- [media-manager](https://github.com/talvbansal/media-manager)

## About Spatie
Spatie is a webdesign agency in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
