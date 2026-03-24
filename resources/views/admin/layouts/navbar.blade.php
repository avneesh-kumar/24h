{{-- resources/views/admin/layouts/navbar.blade.php --}}
@php
    $menu = config('admin_menu');
@endphp

<div class="hidden md:flex flex-col z-10">
    <div class="fixed bg-white min-h-[calc(100vh-4rem)] w-80 justify-between mt-16 dark:bg-gray-900 border-r border-red-500 dark:border-red-900 shadow-2xl p-6 flex flex-col items-start border-t-0">        
        <nav class="w-full mt- space-y-2">
            @foreach($menu as $item)
                <a href="{{ $item['route'] ? route($item['route']) : '#' }}" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-red-50 dark:bg-gray-800 hover:bg-red-100 dark:hover:bg-red-900 transition text-red-500 dark:text-red-300 font-semibold border border-transparent hover:border-red-600 shadow hover:border ">
                    <i class="fas {{ $item['icon'] }} w-5 h-5"></i>
                    <span>{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>
        <div class="w-full mt-8 border-t border-red-200 dark:border-red-900 pt-4 flex flex-col gap-2">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg bg-red-50 dark:bg-gray-800 hover:bg-red-100 dark:hover:bg-red-900 transition text-red-700 dark:text-red-300 font-semibold border border-transparent hover:border-red-600 shadow cursor-pointer">
                    <i class="fas fa-sign-out-alt text-red-500 w-5 h-5"></i>
                    <span>Logout</span>
                </button>
            </form>
            <a href="{{ url('/') }}" target="_blank" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg bg-red-50 dark:bg-gray-800 hover:bg-red-100 dark:hover:bg-red-900 transition text-red-700 dark:text-red-300 font-semibold border border-transparent hover:border-red-600 shadow">
                <i class="fas fa-globe text-red-500 w-5 h-5"></i>
                <span>Website</span>
            </a>
        </div>
    </div>
</div>

<nav class="fixed bottom-0 left-0 right-0 z-50 md:hidden bg-white dark:bg-gray-900 border-t-2 border-red-600 flex overflow-x-auto no-scrollbar py-2 shadow-2xl">
    <div class="flex min-w-full justify-around space-x-2 px-2">
        @foreach($menu as $item)
            <div class="flex-shrink-0 min-w-[60px]">
                <a href="{{ $item['route'] ? route($item['route']) : '#' }}" class="flex flex-col items-center text-xs text-red-700 dark:text-red-300 hover:text-red-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500">
                    <i class="fas {{ $item['icon'] }} text-lg mb-1 text-red-500"></i>
                    <span>{{ $item['label'] }}</span>
                </a>
            </div>
        @endforeach
    </div>
</nav>
