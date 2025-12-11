<aside
    class="fixed inset-y-0 left-0 z-50 w-64 h-full bg-white dark:bg-gray-800 shadow-xl transform sidebar-transition lg:translate-x-0 lg:static lg:inset-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

    @include('components.admin.sidebar-header')

    @include('components.admin.sidebar-navigation')

    @include('components.admin.sidebar-user-info')
</aside>
