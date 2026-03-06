[![Última versión en Packagist](https://img.shields.io/packagist/v/amendozaaguiar/laravel-lat-es.svg?style=flat-square)](https://packagist.org/packages/amendozaaguiar/laravel-lat-es)
[![Descargas Totales](https://img.shields.io/packagist/dt/amendozaaguiar/laravel-lat-es.svg?style=flat-square)](https://packagist.org/packages/amendozaaguiar/laravel-lat-es)

# 🌟 Laravel Español 🇪🇸

El paquete `laravel-lat-es` ofrece traducciones al español latinoamericano para Laravel. Incluye los archivos de idioma por defecto de Laravel traducidos, listos para publicar en tu proyecto con un solo comando.

## Archivos incluidos

```
lang/es/auth.php
lang/es/pagination.php
lang/es/passwords.php
lang/es/validation.php
```

- [Requisitos](#requisitos)
- [Instalación](#instalar)
- [Configuración](#configuracion)
- [Colaborar](#colaborar)

<a name="requisitos"></a>

## 📋 Requisitos

- PHP `^8.2`
- Laravel `^10.0 | ^11.0 | ^12.0`

<a name="instalar"></a>

## 🚀 Instalación

Instala el paquete via Composer:

```bash
composer require amendozaaguiar/laravel-lat-es
```

El `ServiceProvider` se registra automáticamente gracias al [autodiscovery de Laravel](https://medium.com/@taylorotwell/package-auto-discovery-in-laravel-5-5-ea9e3ab20518), no es necesario registrarlo manualmente.

Publica los archivos de traducción con el comando del paquete:

```bash
php artisan laravellates:install
```

O usando directamente `vendor:publish`:

```bash
php artisan vendor:publish --tag=laravel-lat-es-lang
```

<a name="configuracion"></a>

## ⚙️ Configuración

Establece el idioma en `config/app.php`:

```php
'locale' => 'es', // español
'locale' => 'en', // inglés
```

También puedes cambiarlo en tiempo de ejecución (solo para esa petición):

```php
App::setLocale('es');
```

<a name="colaborar"></a>

## 🤝 Colaborar

Estamos abiertos a mejoras y variaciones para países de habla hispana. ¡Aceptamos cualquier contribución a través de un Pull Request con entusiasmo! 😊

## Inspirado

Agradecemos la inspiración de Laravel-Spanish y a ChatGPT por su contribución en la mejora de los textos.
