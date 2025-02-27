[![Última versión en Packagist](https://img.shields.io/packagist/v/amendozaaguiar/laravel-lat-es.svg?style=flat-square)](https://packagist.org/packages/amendozaaguiar/laravel-lat-es)
[![Descargas Totales](https://img.shields.io/packagist/dt/amendozaaguiar/laravel-lat-es.svg?style=flat-square)](https://packagist.org/packages/amendozaaguiar/laravel-lat-es)

# 🌟 Laravel Español 🇪🇸

El paquete "laravel-lat-es" ofrece traducciones en español para Laravel, permitiendo que tus proyectos en Laravel cuenten con los archivos de traducción en español por defecto. Con este paquete, podrás asegurarte de tener una experiencia de usuario en español más fluida y personalizada en tus aplicaciones de Laravel. Además, al utilizar las traducciones por defecto de Laravel, podrás estar seguro de estar utilizando un idioma consistente y coherente a lo largo de toda tu aplicación.

## Versiones

Archivos por defecto incluidos en Laravel:

```
es/auth.php
es/pagination.php
es/passwords.php
es/validation.php
```

- [Instalación](#instalar)
- [Colaborar](#colaborar)

<a name="instalar"></a>

## 🚀 Instalación

Puedes instalar este paquete mediante Composer:

```bash
composer require amendozaaguiar/laravel-lat-es
```

No es necesario agregar el proveedor de servicios en tu fichero `config/app.php` en Laravel 5.5+ gracias al [sistema de autodiscovery](https://medium.com/@taylorotwell/package-auto-discovery-in-laravel-5-5-ea9e3ab20518):

```php
'providers' => [
    // ...
    Amendozaaguiar\LaravelLatEs\LaravelLatEsServiceProvider::class,
];
```

Ahora simplemente necesitamos actualizar las traducciones que lo haremos con el siguiente comando:

```bash
php artisan vendor:publish --tag=lang
```

O también podramos usar:

```bash
php artisan laravellates:install
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

## 🤝 Colaborar

Estamos abiertos a mejoras y variaciones para países de habla hispana. ¡Aceptamos cualquier contribución a través de una solicitud de extracción (Pull-Request) con entusiasmo! 😊

## Inspirado

Agradecemos la inspiración de Laravel-Spanish y agradecemos a ChatGPT por su contribución en la mejora de los textos.
