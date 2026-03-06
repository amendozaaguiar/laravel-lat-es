<?php

namespace Amendozaaguiar\LaravelLatEs\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class CheckLaravelLatEs extends Command
{
    protected $signature = 'laravellates:check
        {--locale=es : Locale a comparar contra el inglés}';

    protected $description = 'Compara lang/en/ con lang/{locale}/ y muestra claves faltantes o desactualizadas.';

    public function handle(): int
    {
        $locale = $this->option('locale');
        $enPath = lang_path('en');
        $esPath = lang_path($locale);

        if (! is_dir($enPath)) {
            $this->error("No existe el directorio lang/en/. Ejecuta primero: php artisan lang:publish");

            return self::FAILURE;
        }

        if (! is_dir($esPath)) {
            $this->error("No existe el directorio lang/{$locale}/. Ejecuta primero: php artisan laravellates:install");

            return self::FAILURE;
        }

        $enFiles  = collect(glob("{$enPath}/*.php"))->mapWithKeys(fn($f) => [basename($f, '.php') => $f]);
        $esFiles  = collect(glob("{$esPath}/*.php"))->mapWithKeys(fn($f) => [basename($f, '.php') => $f]);

        $missingFiles  = $enFiles->keys()->diff($esFiles->keys());
        $orphanFiles   = $esFiles->keys()->diff($enFiles->keys());
        $totalMissing  = 0;
        $totalOrphan   = 0;
        $hasIssues     = false;

        // ── Archivos que faltan en el locale ────────────────────────────────
        if ($missingFiles->isNotEmpty()) {
            $hasIssues = true;
            $this->newLine();
            $this->line("<fg=red;options=bold>Archivos faltantes en lang/{$locale}/:</>");
            $missingFiles->each(fn($file) => $this->line("  <fg=red>✗</> {$file}.php"));
        }

        // ── Archivos extra (en locale pero no en en/) ───────────────────────
        if ($orphanFiles->isNotEmpty()) {
            $hasIssues = true;
            $this->newLine();
            $this->line("<fg=yellow;options=bold>Archivos en lang/{$locale}/ sin contraparte en lang/en/:</>");
            $orphanFiles->each(fn($file) => $this->line("  <fg=yellow>⚠</> {$file}.php"));
        }

        // ── Comparar claves por archivo ──────────────────────────────────────
        $commonFiles = $enFiles->keys()->intersect($esFiles->keys());

        foreach ($commonFiles as $group) {
            $enKeys = Arr::dot(require $enFiles[$group]);
            $esKeys = Arr::dot(require $esFiles[$group]);

            $missing = array_diff_key($enKeys, $esKeys);
            $orphan  = array_diff_key($esKeys, $enKeys);

            if (! empty($missing)) {
                $hasIssues = true;
                $totalMissing += count($missing);
                $this->newLine();
                $this->line("<fg=red;options=bold>{$group}.php — " . count($missing) . " clave(s) faltante(s):</>");
                foreach ($missing as $key => $value) {
                    $this->line("  <fg=red>✗</> {$key}");
                    $this->line("    <fg=gray>EN:</> {$this->truncate((string)$value)}");
                }
            }

            if (! empty($orphan)) {
                $hasIssues = true;
                $totalOrphan += count($orphan);
                $this->newLine();
                $this->line("<fg=yellow;options=bold>{$group}.php — " . count($orphan) . " clave(s) extra (no existen en EN):</>");
                foreach ($orphan as $key => $value) {
                    $this->line("  <fg=yellow>⚠</> {$key}");
                }
            }
        }

        // ── Resumen ──────────────────────────────────────────────────────────
        $this->newLine();

        if (! $hasIssues) {
            $this->line("<fg=green;options=bold>✓ Las traducciones lang/{$locale}/ están sincronizadas con lang/en/</>");

            return self::SUCCESS;
        }

        $this->line("<fg=red;options=bold>Resumen para lang/{$locale}/:</>");

        if ($missingFiles->isNotEmpty()) {
            $this->line("  <fg=red>•</> {$missingFiles->count()} archivo(s) faltante(s)");
        }

        if ($totalMissing > 0) {
            $this->line("  <fg=red>•</> {$totalMissing} clave(s) sin traducir");
        }

        if ($totalOrphan > 0) {
            $this->line("  <fg=yellow>•</> {$totalOrphan} clave(s) extra (obsoletas)");
        }

        return self::FAILURE;
    }

    private function truncate(string $value, int $length = 80): string
    {
        return mb_strlen($value) > $length
            ? mb_substr($value, 0, $length) . '…'
            : $value;
    }
}
