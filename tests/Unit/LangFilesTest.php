<?php

use Illuminate\Support\Arr;

$langPath = __DIR__ . '/../../resources/lang/es';

// ─── Archivos existen ────────────────────────────────────────────────────────

it('tiene el archivo auth.php', function () use ($langPath) {
    expect(file_exists("{$langPath}/auth.php"))->toBeTrue();
});

it('tiene el archivo pagination.php', function () use ($langPath) {
    expect(file_exists("{$langPath}/pagination.php"))->toBeTrue();
});

it('tiene el archivo passwords.php', function () use ($langPath) {
    expect(file_exists("{$langPath}/passwords.php"))->toBeTrue();
});

it('tiene el archivo validation.php', function () use ($langPath) {
    expect(file_exists("{$langPath}/validation.php"))->toBeTrue();
});

// ─── Devuelven arrays ────────────────────────────────────────────────────────

it('auth.php devuelve un array', function () use ($langPath) {
    $data = require "{$langPath}/auth.php";
    expect($data)->toBeArray()->not->toBeEmpty();
});

it('pagination.php devuelve un array', function () use ($langPath) {
    $data = require "{$langPath}/pagination.php";
    expect($data)->toBeArray()->not->toBeEmpty();
});

it('passwords.php devuelve un array', function () use ($langPath) {
    $data = require "{$langPath}/passwords.php";
    expect($data)->toBeArray()->not->toBeEmpty();
});

it('validation.php devuelve un array', function () use ($langPath) {
    $data = require "{$langPath}/validation.php";
    expect($data)->toBeArray()->not->toBeEmpty();
});

// ─── Claves obligatorias ─────────────────────────────────────────────────────

it('auth.php tiene las claves failed, password y throttle', function () use ($langPath) {
    $data = require "{$langPath}/auth.php";
    expect($data)->toHaveKeys(['failed', 'password', 'throttle']);
});

it('pagination.php tiene las claves previous y next', function () use ($langPath) {
    $data = require "{$langPath}/pagination.php";
    expect($data)->toHaveKeys(['previous', 'next']);
});

it('passwords.php tiene las claves reset, sent, throttled, token y user', function () use ($langPath) {
    $data = require "{$langPath}/passwords.php";
    expect($data)->toHaveKeys(['reset', 'sent', 'throttled', 'token', 'user']);
});

it('validation.php tiene las claves requeridas', function () use ($langPath) {
    $data = require "{$langPath}/validation.php";

    $required = ['required', 'email', 'min', 'max', 'unique', 'confirmed', 'string', 'custom', 'attributes'];

    foreach ($required as $key) {
        expect(Arr::has($data, $key))->toBeTrue("Falta la clave '{$key}' en validation.php");
    }
});

// ─── Los valores son strings (no vacíos) ────────────────────────────────────

it('los valores de auth.php son strings no vacíos', function () use ($langPath) {
    $data = require "{$langPath}/auth.php";
    foreach ($data as $key => $value) {
        expect($value)->toBeString()->not->toBeEmpty("El valor de '{$key}' está vacío");
    }
});

it('los valores de pagination.php son strings no vacíos', function () use ($langPath) {
    $data = require "{$langPath}/pagination.php";
    foreach ($data as $key => $value) {
        expect($value)->toBeString()->not->toBeEmpty("El valor de '{$key}' está vacío");
    }
});
