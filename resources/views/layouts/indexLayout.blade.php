<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'Page Title'}}</title>
  @yield('meta')
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles
  @livewireScripts
</head>

<body class="font-sans">

    @yield('content')
    @stack('scripts')


    <script>
        Livewire.on('gotoTop', () => {
            window.scrollTo({
                top: 0,
                left: 0,
                behaviour: 'smooth'
            })
        })
    </script>
</body>
</html>
