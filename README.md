[![Latest Version on Packagist](https://img.shields.io/packagist/v/amendozaaguiar/laravel-lat-es.svg?style=flat-square)](https://packagist.org/packages/amendozaaguiar/laravel-lat-es)
[![Total Downloads](https://img.shields.io/packagist/dt/amendozaaguiar/laravel-lat-es.svg?style=flat-square)](https://packagist.org/packages/amendozaaguiar/laravel-lat-es)

# Laravel Español 9, 10

Paquete de traducciones en español para Laravel 9, 10. Este paquete te agrega a tu proyecto los ficheros de traducciones en español que Laravel 9, 10 trae por defecto.

## Versiones

Archivos por defecto incluidos en Laravel:

```
es.json
es/auth.php
es/passwords.php
es/pagination.php
es/validation.php
```

-   [Instalación](#instalar)
-   [Colaborar](#colaborar)

<a name="instalar"></a>

## Instalación

Puedes instalar este paquete mediante composer:

```bash
composer require amendozaaguiar/laravel-lat-es
```

No es necesario agregar el proveedor de servicios en tu fichero `config/app.php` en Laravel 5.5+ gracias al [sistema de autodiscovery](https://medium.com/@taylorotwell/package-auto-discovery-in-laravel-5-5-ea9e3ab20518):

```php
'providers' => [
    // ...
    Amendozaaguiar\Laravel-lat-es\LatesServiceProvider::class,
];
```

Ahora simplemente necesitamos actualizar las traducciones que lo haremos con el siguiente comando:

```bash
php artisan vendor:publish --tag=lang
```

O también podramos usar:

```bash
php artisan lates:install
```

Déspues de todos estos pasos, ya tenemos disponible nuestras traducciones en español, y solo necesitamos configurar Laravel para que use el idioma deseado.

Esto lo podemos hacer modificando el parámetro `locale` de la configuración de Laravel en `config/app.php`:

```
// Ej: español
'locale'          => 'es',
// Ej: inglés
'locale'          => 'en',
```

Se puede ser mas concreto e indicar las variaciones de un lenguaje:

```
// Inglés americano
'locale' => 'en_US'
// Portugués de Portugal
'locale' => 'pt_PT'
```

Pero en este caso nos valdrá con un español internacional para todos.

También se puede cambiar el idioma en tiempo de ejecución utilizando el método `setLocale` de `App`. Este cambio no es permanente, en la siguiente ejecución se utilizará el valor de configuración por defecto:

```
App::setLocale('es');
```

<a name="colaborar"></a>

## Colaborar

Mejoras y otras variaciones de paises de habla hispana son más que bienvenidas. Cualquier aportación vía Pull-Request ;D

## Inspirado

Inspirado en Laravel-Spanish
