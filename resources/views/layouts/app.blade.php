<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
    <header class="bg-[#333333] p-4">
      <div class="container mx-auto flex justify-between items-center p-4">
        <div>
          <h1 class="text-3xl font-black">CatAdoptions</h1>
        </div>
        <nav class="flex items-center gap-5">
          <a href="#" class="font-bold uppercase text-gray-300">Login</a>
          <a href="#" class="font-bold uppercase text-gray-300">Register</a>
        </nav>
      </div>
    </header>

    <main class="container mx-auto mt-10">
      @yield('content')
    </main>
  </body>
</html>
