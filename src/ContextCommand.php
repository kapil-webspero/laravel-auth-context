<?php

namespace HomeBloks\ProtonAuthContext;

use Illuminate\Console\Command;
use InvalidArgumentException;

class ContextCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'proton:auth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Wallet login & logout!';

    /**
     * The JS Files that need to be exported.
     *
     * @var array
     */

    protected $componentJSFiles = [
        'ProtonLoginButton.js' => 'ProtonLoginButton.jsx',
    ];

    protected $storeJSFiles = [
        'auth.context.js' => 'auth.context.jsx',
    ];

    // protected $rootJSFiles = [
    //     'app.js' => 'app.jsx',
    // ];

    protected $walletLogo = [
        'drone-with-box.svg' => 'drone-with-box.svg',
    ];

    /**
     * Execute the console command.
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public function handle()
    {
        $this->exportJS();
        $this->components->info('Wallet Login generated successfully.');
        $this->components->warn('Please run [npm install && npm run dev] to compile your fresh scaffolding.');
    }

    /**
     * Export the JS Files.
     *
     * @return void
     */
    protected function exportJS()
    {
        foreach ($this->componentJSFiles as $key => $value) {
            if (file_exists($componentJS = $this->getComponentsJsPath($value)) && ! $this->option('force')) {
                if (! $this->components->confirm("The [$value] js file already exists. Do you want to replace it?")) {
                    continue;
                }
            }

            copy(
                __DIR__.'/js/components/'.$key,
                $componentJS
            );
        }

        foreach ($this->storeJSFiles as $key => $value) {
            if (file_exists($storeJS = $this->getStoreJsPath($value)) && ! $this->option('force')) {
                if (! $this->components->confirm("The [$value] js file already exists. Do you want to replace it?")) {
                    continue;
                }
            }

            copy(
                __DIR__.'/js/store/'.$key,
                $storeJS
            );
        }

        // foreach ($this->rootJSFiles as $key => $value) {
        //     if (file_exists($rootJS = $this->getRootJsPath($value)) && ! $this->option('force')) {
        //         if (! $this->components->confirm("The [$value] js file already exists. Do you want to replace it?")) {
        //             continue;
        //         }
        //     }

        //     copy(
        //         __DIR__.'/js/'.$key,
        //         $rootJS
        //     );
        // }

        foreach ($this->walletLogo as $key => $value) {
            if (file_exists($walletSvg = $this->getIconPath($value)) && ! $this->option('force')) {
                if (! $this->components->confirm("The [$value] file already exists. Do you want to replace it?")) {
                    continue;
                }
            }

            copy(
                __DIR__.'/js/icons/'.$key,
                $walletSvg
            );
        }
    }

    /**
     * Get full Components JS path relative to the application's configured JS path.
     *
     * @param  string  $path
     * @return string
     */
    protected function getComponentsJsPath($path)
    {
        if (!is_dir($directory = resource_path('js/components'))) {
            mkdir($directory, 0755, true);
        }

        return implode(DIRECTORY_SEPARATOR, [
            resource_path('js/components'), $path,
        ]);
    }


    /**
     * Get full Store JS path relative to the application's configured JS path.
     *
     * @param  string  $path
     * @return string
     */
    protected function getStoreJsPath($path)
    {
        if (!is_dir($directory = resource_path('js/store'))) {
            mkdir($directory, 0755, true);
        }
        
        return implode(DIRECTORY_SEPARATOR, [
            resource_path('js/store'), $path,
        ]);
    }

    /**
     * Get full Root JS path relative to the application's configured JS path.
     *
     * @param  string  $path
     * @return string
     */
    // protected function getRootJsPath($path)
    // {
    //     if (!is_dir($directory = resource_path('js'))) {
    //         mkdir($directory, 0755, true);
    //     }
        
    //     return implode(DIRECTORY_SEPARATOR, [
    //         resource_path('js'), $path,
    //     ]);
    // }

        /**
     * Get full Icon path relative to the application's configured JS path.
     *
     * @param  string  $path
     * @return string
     */
    protected function getIconPath($path)
    {
        if (!is_dir($directory = resource_path('js/icons'))) {
            mkdir($directory, 0755, true);
        }

        return implode(DIRECTORY_SEPARATOR, [
            resource_path('js/icons'), $path,
        ]);
    }
}
