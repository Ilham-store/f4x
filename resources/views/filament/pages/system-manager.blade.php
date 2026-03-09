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

                <div class="flex justify-between items-center">
                    <span>App Version</span>
                    <div class="flex items-center gap-2">
                        @if($has_update)
                            <span
                                class="inline-flex items-center justify-center rounded-full bg-emerald-100 px-2.5 py-0.5 text-emerald-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="-ms-1 me-1.5 size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>

                                <p class="text-sm whitespace-nowrap animate-pulse font-semibold">Update Available!</p>
                            </span>
                        @endif
                        <span class="font-semibold">{{ $app_version }}</span>
                    </div>
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


        <x-filament::card>

            <h2 class="text-lg font-bold mb-3">Maintenance Mode</h2>

            <div class="space-y-2 text-sm">

                <div class="flex justify-between">
                    <span>Website Status</span>
                    @if(app()->isDownForMaintenance())
                        <span class="text-red-600">Maintenance Active</span>
                    @else
                        <span class="text-green-600">Website Online</span>
                    @endif
                </div>

            </div>

            <div class="space-y-2 text-sm pt-2">

                <div class="flex justify-between">
                    <span>Bypass URL in Maintenance:</span>
                    <p>
                        <a href="{{ url('/admin-bypass-2104') }}" class="text-blue-800 font-semibold">
                            {{ url('/admin-bypass-2104') }}
                        </a>
                    </p>
                </div>

            </div>

        </x-filament::card>

    </div>
</x-filament-panels::page>