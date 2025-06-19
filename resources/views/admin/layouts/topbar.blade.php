<div class="bg-white px-4 dark:bg-gray-900 border-b border-red-500 dark:border-red-900 shadow-2xl flex items-center justify-between fixed top-0 left-0 right-0 z-40 h-16 md:h-16">
    <div class="flex items-center space-x-4">
        <a href="{{ url('/') }}" class="flex items-center space-x-2 text-red-700 dark:text-red-300 hover:text-red-500 transition duration-200">
            <img src="{{ asset('./logo.png') }}" alt="Ready 24h security" class="w-8 h-8 rounded-full shadow-lg" />
            <span class="hidden md:inline font-bold text-lg">Ready 24h Security</span>
        </a>
    </div>
    <div class="flex items-start max-w-xl w-full justify-start">
        <form class="w-full">   
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="Search..." required />
                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Search</button>
            </div>
        </form>
    </div>
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.account') }}" class="flex items-center space-x-2 text-red-700 hover:text-red-400 transition duration-200">
            <i class="fas fa-user-circle text-2xl"></i>
            <span class="hidden md:inline">{{ auth()->user()->name }}</span>
        </a>
    </div>
</div>
