<aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-800 shadow-xl transform sidebar-transition lg:translate-x-0 lg:static lg:inset-0"
       :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
    
    @include('components.partials.sidebar-header')

    @include('components.partials.sidebar-navigation')

    @include('components.partials.sidebar-user-info')
</aside>