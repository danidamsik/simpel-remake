@php
    $user = auth()->user();
    $initials = 'U';
    $profilePhotoUrl = null;
    $username = 'Guest';
    $role = 'User';

    if ($user) {
        // Get initials from username
        $words = explode(' ', $user->username ?? 'User');
        $initials = '';
        foreach (array_slice($words, 0, 2) as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        $initials = $initials ?: 'U';

        // Get profile photo URL
        if ($user->profile_path) {
            $profilePhotoUrl = Storage::url($user->profile_path);
        }

        $username = $user->username ?? 'User';
        $role = ucfirst($user->role ?? 'User');
    }
@endphp

<div class="border-t border-gray-100 dark:border-gray-700 p-4 bg-white dark:bg-gray-800">
    <div class="flex items-center space-x-3">
        <!-- Profile Photo / Initials -->
        <div class="w-12 h-12 rounded-xl flex items-center justify-center shadow-md overflow-hidden">
            @if ($profilePhotoUrl)
                <img src="{{ $profilePhotoUrl }}" alt="{{ $username }}" class="w-full h-full object-cover">
            @else
                <div
                    class="w-full h-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center">
                    <span class="text-white font-semibold text-sm">{{ $initials }}</span>
                </div>
            @endif
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ $username }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $role }}</p>
        </div>
    </div>
</div>
