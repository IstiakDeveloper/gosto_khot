<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gosto Khor | 2024</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-transparent-filter {
            backdrop-filter: blur(10px) brightness(90%);
        }

    </style>
</head>
<body>
    <div class="container mx-auto">
        <nav class="bg-transparent-filter shadow-lg">
            <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                <div class="relative flex items-center justify-center h-16">
                    <div class="flex space-x-4">
                        <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'bg-gray-900 text-white' : 'text-gray-900' }} px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700 hover:text-white transition ease-in-out duration-150">Login</a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="mt-6">
            {{$slot}}
        </div>
    </div>
</body>
</html>
