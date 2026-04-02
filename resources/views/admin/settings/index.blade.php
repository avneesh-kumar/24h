@extends('admin.layouts.app')

@section('content')
<div class="w-full">
    <div class="bg-white border border-red-200 shadow-2xl rounded-lg mb-8 p-4">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-red-700 mb-2">Settings</h1>
            <p class="text-red-600 font-medium">Manage your application settings</p>
        </div>
        @if (session('status'))
            <div class="mb-6 p-4 bg-red-50 border border-green-500 rounded-lg">
                <p class="text-green-700">{{ session('status') }}</p>
            </div>
        @endif

        {{-- Tab buttons (outside any form) --}}
        <div class="flex flex-wrap gap-2 border-b border-red-200 mb-6 bg-white rounded-t-lg shadow-sm">
            @foreach($settings as $group => $groupSettings)
                <button type="button"
                        class="tab-btn px-6 py-3 font-semibold focus:outline-none border-b-2 border-transparent bg-transparent transition text-gray-700 hover:bg-red-50 hover:text-red-700 rounded-t-lg"
                        id="tab-{{ $group }}"
                        data-group="{{ $group }}">
                    {{ ucfirst($group) }}
                </button>
            @endforeach
            <button type="button"
                    class="tab-btn px-6 py-3 font-semibold focus:outline-none border-b-2 border-transparent bg-transparent transition text-gray-700 hover:bg-red-50 hover:text-red-700 rounded-t-lg"
                    id="tab-sitemap"
                    data-group="sitemap">
                Sitemap
            </button>
            <button type="button"
                    class="tab-btn px-6 py-3 font-semibold focus:outline-none border-b-2 border-transparent bg-transparent transition text-gray-700 hover:bg-red-50 hover:text-red-700 rounded-t-lg"
                    id="tab-robots"
                    data-group="robots">
                Robots.txt
            </button>
        </div>
        <div id="tab-underline" class="h-0.5 bg-red-600 transition-all duration-300 mb-6"></div>

        {{-- Settings tabs (inside the main form) --}}
        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
            @csrf
            @foreach($settings as $group => $groupSettings)
                <div class="tab-content hidden" id="tab-content-{{ $group }}">
                    <div class="overflow-x-auto rounded-lg border border-red-200 bg-white">
                        <table class="min-w-full divide-y divide-red-200">
                            <thead>
                                <tr class="bg-red-50">
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-red-700 uppercase tracking-wider w-1/3">Setting</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-red-700 uppercase tracking-wider w-2/3">Value</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-red-100">
                                @foreach($groupSettings as $setting)
                                    <tr class="hover:bg-red-50 transition-colors">
                                        <td class="px-6 py-4 align-top">
                                            <span class="font-medium text-gray-900">{{ ucwords(str_replace('_', ' ', $setting->key)) }}</span>
                                        </td>
                                        <td class="px-6 py-4 align-top">
                                            @php
                                                $type = $setting->type;
                                                $key = $setting->key;
                                                $value = $setting->value;
                                                $options = config('setting_options.' . $key, []);
                                            @endphp
                                            @switch($type)
                                                @case('bool')
                                                    <div class="flex items-center space-x-3">
                                                        <label class="relative inline-flex items-center cursor-pointer">
                                                            <input type="checkbox" name="{{ $key }}" value="1" class="sr-only peer" @if($value==1||$value==='1') checked @endif>
                                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                                                        </label>
                                                        <span class="text-sm font-medium {{ $value==1||$value==='1' ? 'text-red-600' : 'text-gray-500' }}">
                                                            {{ $value==1||$value==='1' ? 'Enabled' : 'Disabled' }}
                                                        </span>
                                                    </div>
                                                    @break
                                                @case('text')
                                                    <textarea name="{{ $key }}"
                                                            class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                                            rows="3">{{ $value }}</textarea>
                                                    @break
                                                @case('int')
                                                @case('string')
                                                    @if(!empty($options))
                                                        <select name="{{ $key }}" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                                            @foreach($options as $optKey => $optLabel)
                                                                <option value="{{ $optKey }}" @if($value == $optKey) selected @endif>{{ $optLabel }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if($key === 'timezone')
                                                            <p class="mt-1 text-sm text-gray-500">Current server timezone: {{ date_default_timezone_get() }}</p>
                                                        @endif
                                                    @elseif($key === 'site_logo')
                                                        <div class="space-y-2">
                                                            <input type="file"
                                                                   name="site_logo"
                                                                   class="block w-full text-gray-900 border border-red-200 rounded-lg px-4 py-2 bg-white focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                                            @if($value)
                                                                <div class="mt-2 p-2 bg-white rounded-lg inline-block border border-red-200">
                                                                    <img src="{{ asset('storage/' . $value) }}" alt="Logo" class="h-12">
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <input type="text"
                                                               name="{{ $key }}"
                                                               value="{{ $value }}"
                                                               class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                                    @endif
                                                    @break
                                                @default
                                                    <input type="text"
                                                           name="{{ $key }}"
                                                           value="{{ $value }}"
                                                           class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                            @endswitch
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach

            <div class="text-left mt-6 settings-save-btn hidden">
                <button type="submit"
                        class="inline-flex items-center justify-center px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-200 hover:shadow-lg">
                    Save All Settings
                </button>
            </div>
        </form>

        {{-- Sitemap Tab (outside main form to avoid nesting) --}}
        <div class="tab-content hidden" id="tab-content-sitemap">
            @if(session('status') === 'sitemap_generated')
                <div class="mb-4 p-4 bg-green-50 border border-green-400 rounded-lg">
                    <p class="text-green-700">Sitemap generated successfully at <code>public/sitemap.xml</code></p>
                </div>
            @endif
            <div class="rounded-lg border border-red-200 bg-white p-6 space-y-6">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 mb-1">XML Sitemap</h2>
                    <p class="text-sm text-gray-500 mb-4">Generate a sitemap.xml file in the public folder. It will include all pages, services, areas, industries, and blog posts.</p>
                    <div class="flex gap-3">
                        <form method="POST" action="{{ route('admin.settings.sitemap.generate') }}">
                            @csrf
                            <button type="submit"
                                    class="inline-flex items-center px-5 py-2.5 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Generate Sitemap
                            </button>
                        </form>
                        @if(file_exists(public_path('sitemap.xml')))
                            <a href="{{ asset('sitemap.xml') }}" target="_blank"
                               class="inline-flex items-center px-5 py-2.5 bg-white border border-red-300 text-red-700 font-semibold rounded-lg hover:bg-red-50 transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                                View sitemap.xml
                            </a>
                        @endif
                    </div>
                </div>
                @if(file_exists(public_path('sitemap.xml')))
                    <div>
                        <p class="text-sm text-gray-500 mb-2">Current sitemap preview:</p>
                        <pre class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-xs text-gray-700 overflow-auto max-h-64">{{ htmlspecialchars(file_get_contents(public_path('sitemap.xml'))) }}</pre>
                    </div>
                @endif
            </div>
        </div>

        {{-- Robots.txt Tab (outside main form to avoid nesting) --}}
        <div class="tab-content hidden" id="tab-content-robots">
            @if(session('status') === 'robots_saved')
                <div class="mb-4 p-4 bg-green-50 border border-green-400 rounded-lg">
                    <p class="text-green-700">robots.txt saved successfully to <code>public/robots.txt</code></p>
                </div>
            @endif
            <div class="rounded-lg border border-red-200 bg-white p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-1">Robots.txt</h2>
                <p class="text-sm text-gray-500 mb-4">Edit and save your robots.txt file. This will be written directly to the public folder.</p>
                <form method="POST" action="{{ route('admin.settings.robots.save') }}">
                    @csrf
                    <textarea name="robots_content" rows="14"
                              class="w-full bg-white border border-red-200 text-gray-900 font-mono text-sm rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 mb-4">{{ $robotsContent }}</textarea>
                    <button type="submit"
                            class="inline-flex items-center px-5 py-2.5 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                        </svg>
                        Save robots.txt
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.tab-btn');
        const contents = document.querySelectorAll('.tab-content');
        const tabUnderline = document.getElementById('tab-underline');

        function activateTab(group) {
            tabs.forEach(tab => {
                tab.classList.remove('text-red-700', 'border-red-600', 'font-bold');
                tab.classList.add('text-gray-400', 'border-transparent');
            });
            contents.forEach(content => content.classList.add('hidden'));

            const activeTab = document.getElementById('tab-' + group);
            if (!activeTab) return;
            activeTab.classList.remove('text-gray-400', 'border-transparent');
            activeTab.classList.add('text-red-700', 'border-red-600', 'font-bold');
            const content = document.getElementById('tab-content-' + group);
            if (content) content.classList.remove('hidden');

            // Show Save button only for settings tabs, not sitemap/robots
            const saveBtn = document.querySelector('.settings-save-btn');
            if (saveBtn) {
                if (group === 'sitemap' || group === 'robots') {
                    saveBtn.classList.add('hidden');
                } else {
                    saveBtn.classList.remove('hidden');
                }
            }

            moveUnderlineToTab(activeTab);
        }

        function moveUnderlineToTab(tab) {
            if (!tab) return;
            const rect = tab.getBoundingClientRect();
            const parentRect = tab.parentElement.parentElement.getBoundingClientRect();
            tabUnderline.style.width = rect.width + 'px';
            tabUnderline.style.left = (rect.left - parentRect.left) + 'px';
        }

        // Check URL param for active tab (used after sitemap/robots redirect)
        const urlParams = new URLSearchParams(window.location.search);
        const tabParam = urlParams.get('tab');

        if (tabs.length) {
            const initialGroup = tabParam || tabs[0].dataset.group;
            activateTab(initialGroup);
            tabs.forEach(tab => {
                tab.addEventListener('click', () => activateTab(tab.dataset.group));
            });
        }

        window.addEventListener('resize', function() {
            const activeTab = document.querySelector('.tab-btn.text-red-700');
            if (activeTab) moveUnderlineToTab(activeTab);
        });
    });
</script>
@endsection
