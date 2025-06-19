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

        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-8">
                <div class="flex flex-wrap gap-2 border-b border-red-200 mb-6 bg-white rounded-t-lg shadow-sm">
                    @foreach($settings as $group => $groupSettings)
                        <button type="button"
                                class="tab-btn px-6 py-3 font-semibold focus:outline-none border-b-2 border-transparent bg-transparent transition text-gray-700 hover:bg-red-50 hover:text-red-700 rounded-t-lg"
                                id="tab-{{ $group }}"
                                data-group="{{ $group }}">
                            {{ ucfirst($group) }}
                        </button>
                    @endforeach
                </div>
                <div id="tab-underline" class="h-0.5 bg-red-600 transition-all duration-300"></div>

                @foreach($settings as $group => $groupSettings)
                    <div class="tab-content {{ !$loop->first ? 'hidden' : '' }}" id="tab-content-{{ $group }}">
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
            </div>

            <div class="text-left">
                <button type="submit"
                        class="inline-flex items-center justify-center px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-200 hover:shadow-lg">
                    Save All Settings
                </button>
            </div>
        </form>
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
            activeTab.classList.remove('text-gray-400', 'border-transparent');
            activeTab.classList.add('text-red-700', 'border-red-600', 'font-bold');
            document.getElementById('tab-content-' + group).classList.remove('hidden');

            moveUnderlineToTab(activeTab);
        }

        function moveUnderlineToTab(tab) {
            if (!tab) return;
            const rect = tab.getBoundingClientRect();
            const parentRect = tab.parentElement.parentElement.getBoundingClientRect();
            tabUnderline.style.width = rect.width + 'px';
            tabUnderline.style.left = (rect.left - parentRect.left) + 'px';
        }

        if (tabs.length) {
            activateTab(tabs[0].dataset.group);
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
