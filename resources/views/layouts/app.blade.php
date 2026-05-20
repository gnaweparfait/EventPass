<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle ?? 'EventPass' }} — {{ config('app.name', 'EventPass') }}</title>
    @include('layouts.partials.head-assets')
</head>
<body class="ep-app-bg font-sans text-slate-900 antialiased" x-data="{ sidebarOpen: false }">
    @include('layouts.partials.sidebar')

    <div class="lg:pl-[17rem]">
        @include('layouts.partials.navbar')

        <main class="p-4 sm:p-6 lg:p-8">
            @include('layouts.partials.flash')
            {{ $slot }}
        </main>
    </div>
</body>
</html>
