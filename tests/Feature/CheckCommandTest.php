<?php

use Illuminate\Support\Facades\Artisan;

// ─── laravellates:check ───────────────────────────────────────────────────────

it('el comando laravellates:check existe', function () {
    expect(array_keys(Artisan::all()))->toContain('laravellates:check');
});

it('laravellates:check falla si no existe lang/en/', function () {
    // Nos aseguramos de que lang/en no existe en el entorno de test
    $enPath = lang_path('en');
    if (is_dir($enPath)) {
        collect(glob("{$enPath}/*.php"))->each(fn($f) => unlink($f));
        rmdir($enPath);
    }

    $exit = Artisan::call('laravellates:check');

    expect($exit)->toBe(1);
});

it('laravellates:check falla si no existe lang/{locale}/', function () {
    // Publicamos lang/en pero no lang/es
    $enPath = lang_path('en');
    if (! is_dir($enPath)) {
        mkdir($enPath, 0755, true);
        file_put_contents("{$enPath}/auth.php", "<?php\nreturn ['failed' => 'These credentials do not match.'];");
    }

    $esPath = lang_path('es');
    if (is_dir($esPath)) {
        collect(glob("{$esPath}/*.php"))->each(fn($f) => unlink($f));
        rmdir($esPath);
    }

    $exit = Artisan::call('laravellates:check');

    expect($exit)->toBe(1);
});

it('laravellates:check pasa cuando los archivos están sincronizados', function () {
    // Crea lang/en y lang/es con las mismas claves
    $keys = ['failed' => 'These credentials do not match.'];

    foreach (['en', 'es'] as $locale) {
        $path = lang_path($locale);
        if (! is_dir($path)) {
            mkdir($path, 0755, true);
        }
        file_put_contents("{$path}/auth.php", "<?php\nreturn " . var_export($keys, true) . ";");
    }

    $exit = Artisan::call('laravellates:check');

    expect($exit)->toBe(0);
});

it('laravellates:check detecta claves faltantes en el locale', function () {
    $enPath = lang_path('en');
    $esPath = lang_path('es');

    if (! is_dir($enPath)) {
        mkdir($enPath, 0755, true);
    }
    if (! is_dir($esPath)) {
        mkdir($esPath, 0755, true);
    }

    // EN tiene dos claves, ES solo tiene una
    file_put_contents("{$enPath}/auth.php", "<?php\nreturn ['failed' => 'These credentials do not match.', 'throttle' => 'Too many attempts.'];");
    file_put_contents("{$esPath}/auth.php", "<?php\nreturn ['failed' => 'Credenciales incorrectas.'];");

    $exit = Artisan::call('laravellates:check');

    expect($exit)->toBe(1); // debe reportar clave faltante
});

it('laravellates:check acepta la opción --locale', function () {
    $exit = Artisan::call('laravellates:check', ['--locale' => 'fr']);
    // fr no existe, debe fallar
    expect($exit)->toBe(1);
});
