---
name: laravel-lat-es
description: "Traducciones al español latinoamericano para Laravel. Actívate cuando el usuario trabaje con traducciones, idiomas, localización, archivos lang/, claves de validación, autenticación o paginación en español, o cuando mencione traducción, español, locale, lang o laravellates:install."
license: MIT
metadata:
  author: amendozaaguiar
---
# laravel-lat-es — Traducciones en Español para Laravel

## Descripción del paquete

`amendozaaguiar/laravel-lat-es` publica los archivos de traducción por defecto de Laravel al español latinoamericano en
el directorio `lang/es/` del proyecto.

## Archivos incluidos

```
lang/es/auth.php → mensajes de autenticación (login fallido, throttle, contraseña)
lang/es/pagination.php → textos de paginación (Anterior / Siguiente)
lang/es/passwords.php → mensajes de restablecimiento de contraseña
lang/es/validation.php → todos los mensajes de error de validación de Laravel
```

## Instalación y publicación

```bash
# Instalar el paquete
composer require amendozaaguiar/laravel-lat-es

# Publicar los archivos de traducción (comando del paquete)
php artisan laravellates:install

# O con vendor:publish directamente
php artisan vendor:publish --tag=laravel-lat-es-lang
```

## Configurar el idioma en la app

En `config/app.php`:

```php
'locale' => 'es', // español por defecto
'fallback_locale' => 'en', // inglés como respaldo
```

Cambiar en tiempo de ejecución (solo para esa request):

```php
App::setLocale('es');
// o
app()->setLocale('es');
```

## Usar las traducciones en código

```php
// Helper __()
__('auth.failed') // → "Estas credenciales no coinciden con nuestros registros."
__('pagination.next') // → "Siguiente »"
__('passwords.reset') // → "Tu contraseña ha sido restablecida."
__('validation.required', ['attribute' => 'nombre']) // → "El campo nombre es obligatorio."

// Con parámetros
__('auth.throttle', ['seconds' => 60]) // → "Demasiados intentos... en 60 segundos."
```

## Claves disponibles por archivo

### `auth.php`
- `failed` — credenciales incorrectas
- `password` — contraseña incorrecta
- `throttle` — demasiados intentos (parámetro `:seconds`)

### `pagination.php`
- `previous` — enlace página anterior
- `next` — enlace página siguiente

### `passwords.php`
- `reset`, `sent`, `throttled`, `token`, `user`

### `validation.php`
Contiene todas las reglas de validación de Laravel: `required`, `email`, `min`, `max`, `unique`, `confirmed`, `string`,
`integer`, `boolean`, `date`, `url`, `regex`, y muchas más. También incluye las claves `custom` y `attributes` para
personalización.

## Agregar traducciones personalizadas

No modifiques los archivos publicados por el paquete directamente, ya que se sobreescribirán al actualizar. En su lugar,
usa la clave `custom` de `validation.php`:

```php
// lang/es/validation.php
'custom' => [
'email' => [
'unique' => 'Este correo ya está registrado.',
],
],
'attributes' => [
'email' => 'correo electrónico',
'password' => 'contraseña',
'name' => 'nombre',
],
```

## Comando Artisan

```bash
php artisan laravellates:install
```
- Publica los 4 archivos de traducción en `lang/es/`
- El ServiceProvider se auto-registra, no es necesario agregarlo manualmente
- El tag de publicación es `laravel-lat-es-lang`
