<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cat Adoptions App</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body class="bg-[#222222] text-[#eeeeee]">
    <header class="bg-[#333333] p-2">
      <div class="container mx-auto flex justify-between items-center p-4">
        <div>
          <a href="{{ route('home') }}">
            <h1 class="text-3xl font-black">CatAdoptions</h1>
          </a>
        </div>
        <nav class="flex items-center gap-4">
          @auth
            <a href="{{ route('cats.create') }}" class="mr-3 font-medium text-[17px]">Add Cat</a>
            <a href="#" class="underline font-medium text-[17px]">{{ auth()->user()->email }}</a>
            <form action="{{ route('logout') }}" method="post">
              @csrf

              <button type="submit" class="text-gray-300 font-medium text-[17px] cursor-pointer">Logout</button>
            </form>
          @endauth
          @guest
            <a href="{{ route('login') }}" class="font-medium text-[17px] text-gray-300">Login</a>
            <a href="{{ route('register') }}" class="font-medium text-[17px] text-gray-300">Register</a>
          @endguest
        </nav>
      </div>
    </header>

    <main class="container mx-auto mt-14">
      <h2 class="text-3xl font-black text-center mb-10">
        @yield('title')
      </h2>
      @yield('content')
    </main>
  </body>
</html>
