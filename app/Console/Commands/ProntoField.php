<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProntoField extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pronto:field {FieldEntry}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Pronto Field';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $entry = $this->argument('FieldEntry');

        $partialNamespace = '';

        if (Str::contains($entry, '/')) {
            $partialNamespace = Str::beforeLast($entry, '/');
        }

        $fieldName = Str::afterLast($entry, '/');

        $partialNamespaceDirectory = empty($partialNamespace)
            ? ''
            : "/" . $partialNamespace;

        $backendStubPath = base_path('stubs/pronto.field.backend.stub');
        $frontendStubPath = base_path('stubs/pronto.field.frontend.stub');

        $backendFieldPath = app_path('Fields' . $partialNamespaceDirectory . '/' . $fieldName . '.php');
        $frontendFieldPath = resource_path('frontend/Fields' . $partialNamespaceDirectory . '/' . $fieldName . '.vue');

        $backendFieldDirectory = File::dirname($backendFieldPath);
        $frontendFieldDirectory = File::dirname($backendFieldPath);

        File::ensureDirectoryExists($backendFieldDirectory);
        File::ensureDirectoryExists($frontendFieldDirectory);

        File::copy($backendStubPath, $backendFieldPath);
        File::copy($frontendStubPath, $frontendFieldPath);

        $partialNamespaceReplacement = empty($partialNamespace)
            ? ''
            : "\\" . $partialNamespace;

        File::replaceInFile(
            ['{{ PartialNamespace }}', '{{ FieldName }}'],
            [$partialNamespaceReplacement, $fieldName],
            $backendFieldPath
        );

        return 0;
    }
}
