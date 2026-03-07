<x-filament-panels::page>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="/images/a4florist_logo.svg" type="image/svg+xml">
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        <title>System Manager - A4Florist</title>
    </head>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <x-filament::card>
            <h2 class="text-lg font-bold mb-3">Application Info</h2>

            <div class="space-y-2 text-sm">

                <div class="flex justify-between">
                    <span>App Version</span>
                    <span class="font-semibold">{{ $app_version }}</span>
                </div>

                <div class="flex justify-between">
                    <span>Laravel Version</span>
                    <span>{{ $laravel_version }}</span>
                </div>

                <div class="flex justify-between">
                    <span>PHP Version</span>
                    <span>{{ $php_version }}</span>
                </div>

                <div class="flex justify-between">
                    <span>Environment</span>
                    <span>{{ $app_env }}</span>
                </div>

                <div class="flex justify-between">
                    <span>Debug Mode</span>
                    <span>{{ $app_debug ? 'ON' : 'OFF' }}</span>
                </div>

                <div class="flex justify-between">
                    <span>App URL</span>
                    <span>{{ $app_url }}</span>
                </div>

            </div>
        </x-filament::card>


        <x-filament::card>
            <h2 class="text-lg font-bold mb-3">Server</h2>

            <div class="space-y-2 text-sm">

                <div class="flex justify-between">
                    <span>Server Time</span>
                    <span>{{ now() }}</span>
                </div>

                <div class="flex justify-between">
                    <span>Memory Limit</span>
                    <span>{{ ini_get('memory_limit') }}</span>
                </div>

                <div class="flex justify-between">
                    <span>Upload Max Filesize</span>
                    <span>{{ ini_get('upload_max_filesize') }}</span>
                </div>

                <div class="flex justify-between">
                    <span>Post Max Size</span>
                    <span>{{ ini_get('post_max_size') }}</span>
                </div>

            </div>
        </x-filament::card>

    </div>
</x-filament-panels::page>