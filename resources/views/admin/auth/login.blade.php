<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMS Sign In — Ecowattage</title>
    <link rel="icon" type="image/png" href="{{ asset('images/ecowattage-emblem.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-eco-forest min-h-screen flex items-center justify-center p-4 antialiased">
    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl border border-eco-border p-8 sm:p-10 space-y-6">
        <div class="text-center space-y-2">
            <img src="{{ asset('images/ecowattage-official-logo.png') }}" alt="Ecowattage" class="h-14 w-auto mx-auto object-contain">
            <h1 class="text-2xl font-heading font-bold text-eco-heading">Ecowattage CMS Portal</h1>
            <p class="text-xs sm:text-sm text-eco-body">
                Sign in to manage pages, visibility controls, SEO metadata, media, and modular content.
            </p>
        </div>

        @if ($errors->any())
            <div class="p-3.5 rounded-xl bg-red-50 border border-red-200 text-xs text-red-800">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="login-email" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-1.5">
                    Email Address
                </label>
                <input
                    id="login-email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    placeholder="admin@ecowattage.com"
                    class="w-full px-4 py-3 rounded-xl bg-eco-surface border border-eco-border text-sm text-eco-charcoal focus:outline-none focus:border-eco-green"
                >
            </div>

            <div>
                <label for="login-password" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-1.5">
                    Password
                </label>
                <input
                    id="login-password"
                    type="password"
                    name="password"
                    required
                    placeholder="••••••••"
                    class="w-full px-4 py-3 rounded-xl bg-eco-surface border border-eco-border text-sm text-eco-charcoal focus:outline-none focus:border-eco-green"
                >
            </div>

            <button type="submit" class="btn-eco-primary w-full justify-center !py-3 text-sm cursor-pointer">
                <span>Sign In to CMS</span>
            </button>
        </form>

        <div class="pt-3 border-t border-eco-border text-center">
            <a href="{{ route('home') }}" class="text-xs font-heading font-bold text-eco-green hover:text-eco-forest transition">
                &larr; Return to Public Website
            </a>
        </div>
    </div>
</body>
</html>
