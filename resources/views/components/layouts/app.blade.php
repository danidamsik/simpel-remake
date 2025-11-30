<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('components.partials.head')
</head>

<body class="bg-gray-50 dark:bg-gray-900 font-sans antialiased transition-colors duration-300" 
      x-data="{ 
          sidebarOpen: false, 
          darkMode: localStorage.getItem('darkMode') === 'true' || false,
          init() {
              this.$watch('darkMode', val => {
                  localStorage.setItem('darkMode', val);
                  document.documentElement.classList.toggle('dark', val);
              });
              
              if (this.darkMode) {
                  document.documentElement.classList.add('dark');
              }
          }
      }">

    <div class="flex h-screen overflow-hidden">
        @include('components.partials.sidebar')

        <!-- ===== MAIN CONTENT ===== -->
        <div class="flex-1 flex flex-col overflow-hidden">
            @include('components.partials.header')

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto bg-gray-50 dark:bg-gray-900 p-6 transition-colors duration-300">
                {{ $slot }}
            </main>
        </div>
    </div>

    @include('components.partials.mobile-overlay')
    
    @livewireScripts
</body>
</html>