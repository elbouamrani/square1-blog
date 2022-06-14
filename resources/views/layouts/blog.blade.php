<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>@yield('title', config('app.name'))</title>
        @stack('meta')
        <link rel="stylesheet" href="{{ mix('css/app.css') }}"/>
        @stack('styles')
    </head>
    <body class="bg-gray-100 font-sans leading-normal tracking-normal flex flex-col min-h-screen">
        <nav>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-wrap items-center justify-between mt-0 py-3">
                <div class="pl-3">
                    <a class="text-gray-900 no-underline hover:no-underline font-extrabold text-3xl" href="{{ route('blog.home') }}">
                    Square Post
                    </a>
                </div>
                
                <div>
                    <ul class="list-reset">
                        <li>
                            <a class="inline-block py-2 px-4 text-gray-900 font-bold no-underline" href="{{ route('dashboard') }}">Contribute</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        @yield('content')
        <footer class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-full border-t">
            <div class="py-8 text-center">
                <p class="text-gray-600 text-sm">
                    Inspiring Articles, Contributed by the community.
                </p>
            </div>
        </footer>
        @stack('scripts')
    </body>
</html>