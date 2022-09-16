<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProntoForm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pronto:form {FormEntry}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Pronto Form';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $entry = $this->argument('FormEntry');

        $partialNamespace = '';

        if (Str::contains($entry, '/')) {
            $partialNamespace = Str::beforeLast($entry, '/');
        }

        $formName = Str::afterLast($entry, '/');

        // $stub = File::get(base_path('stubs/pronto.form.stub'));

        $partialNamespaceDirectory = empty($partialNamespace)
            ? ''
            : "/" . $partialNamespace;

        $stubPath = base_path('stubs/pronto.form.stub');

        $formPath = app_path('Forms' . $partialNamespaceDirectory . '/' . $formName . '.php');

        $formDirectory = File::dirname($formPath);

        File::ensureDirectoryExists($formDirectory);

        File::copy($stubPath, $formPath);

        $partialNamespaceReplacement = empty($partialNamespace)
            ? ''
            : "\\" . $partialNamespace;

        File::replaceInFile(
            ['{{ PartialNamespace }}', '{{ FormName }}'],
            [$partialNamespaceReplacement, $formName],
            $formPath
        );

        // $contents = str_replace(
        //     ['{{ PartialNamespace }}', '{{ FormName }}'],
        //     [$partialNamespaceReplacement, $formName],
        //     $stub
        // );

        // File::put($filePath, $contents);

        return 0;
    }
}
