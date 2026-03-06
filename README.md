[![Última versión en Packagist](https://img.shields.io/packagist/v/amendozaaguiar/laravel-lat-es.svg?style=flat-square)](https://packagist.org/packages/amendozaaguiar/laravel-lat-es)
[![Descargas Totales](https://img.shields.io/packagist/dt/amendozaaguiar/laravel-lat-es.svg?style=flat-square)](https://packagist.org/packages/amendozaaguiar/laravel-lat-es)
[![Tests](https://img.shields.io/github/actions/workflow/status/amendozaaguiar/laravel-lat-es/tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/amendozaaguiar/laravel-lat-es/actions/workflows/tests.yml)
[![PHP](https://img.shields.io/packagist/dependency-v/amendozaaguiar/laravel-lat-es/php?style=flat-square&logo=php&logoColor=white)](https://packagist.org/packages/amendozaaguiar/laravel-lat-es)
[![Laravel](https://img.shields.io/badge/Laravel-10%20|%2011%20|%2012-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![Licencia](https://img.shields.io/packagist/l/amendozaaguiar/laravel-lat-es.svg?style=flat-square)](LICENSE)

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
- [Laravel Boost](#boost)
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

<a name="boost"></a>

## 🤖 Laravel Boost

Este paquete incluye soporte nativo para [Laravel Boost](https://laravel.com/docs/boost), lo que permite que los agentes de IA (GitHub Copilot, Claude Code, Cursor, etc.) tengan contexto automático sobre las traducciones disponibles.

### Guideline automática

Cuando el paquete está instalado y se ejecuta `boost:update`, los agentes reciben automáticamente una guideline informándoles que el proyecto tiene traducciones al español disponibles en `lang/es/`.

### Skill activable

El paquete incluye la skill `laravel-lat-es` con documentación completa de todas las claves de traducción disponibles. Para activarla, añade el paquete a tu `boost.json`:

```json
{
    "packages": ["amendozaaguiar/laravel-lat-es"],
    "skills": ["laravel-lat-es"]
}
```

Luego actualiza las guidelines:

```bash
php artisan boost:update
```

A partir de ese momento, el agente de IA sabrá exactamente qué claves existen, cómo usar el helper `__()` con ellas, y cuándo activar la skill completa.

<a name="colaborar"></a>

## 🤝 Colaborar

Estamos abiertos a mejoras y variaciones para países de habla hispana. ¡Aceptamos cualquier contribución a través de un Pull Request con entusiasmo! 😊

## Inspirado

Agradecemos la inspiración de Laravel-Spanish y a ChatGPT por su contribución en la mejora de los textos.
