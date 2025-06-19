@extends('admin.layouts.app')

@section('content')
<div class="p-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-sm p-6 flex items-center">
            <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center mr-4">
                <i class="fas fa-industry text-white text-xl"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-900">{{ $stats['total_industries'] }}</h3>
                <p class="text-gray-600">Total Industries</p>
                <span class="inline-block px-2 py-1 text-xs font-semibold text-green-600 bg-green-100 rounded-full">
                    {{ $stats['active_industries'] }} Active
                </span>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 flex items-center">
            <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mr-4">
                <i class="fas fa-shield-alt text-white text-xl"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-900">{{ $stats['total_services'] }}</h3>
                <p class="text-gray-600">Total Services</p>
                <span class="inline-block px-2 py-1 text-xs font-semibold text-green-600 bg-green-100 rounded-full">
                    {{ $stats['active_services'] }} Active
                </span>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 flex items-center">
            <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mr-4">
                <i class="fas fa-map-marker-alt text-white text-xl"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-900">{{ $stats['total_areas'] }}</h3>
                <p class="text-gray-600">Total Areas</p>
                <span class="inline-block px-2 py-1 text-xs font-semibold text-green-600 bg-green-100 rounded-full">
                    {{ $stats['active_areas'] }} Active
                </span>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 flex items-center">
            <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center mr-4">
                <i class="fas fa-comments text-white text-xl"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-900">{{ $stats['total_testimonials'] }}</h3>
                <p class="text-gray-600">Total Testimonials</p>
                <span class="inline-block px-2 py-1 text-xs font-semibold text-green-600 bg-green-100 rounded-full">
                    {{ $stats['active_testimonials'] }} Active
                </span>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h4 class="text-lg font-semibold text-gray-900 mb-4">Industries Distribution</h4>
            <div style="height: 300px;">
                <canvas id="industriesChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <h4 class="text-lg font-semibold text-gray-900 mb-4">Services Distribution</h4>
            <div style="height: 300px;">
                <canvas id="servicesChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Performance Metrics and Recent Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h4 class="text-lg font-semibold text-gray-900 mb-4">Performance Metrics</h4>
            <div class="space-y-4">
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-gray-600">Response Time</span>
                    <span class="font-semibold text-gray-900">{{ $performanceMetrics['response_time'] }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-gray-600">Uptime</span>
                    <span class="font-semibold text-gray-900">{{ $performanceMetrics['uptime'] }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-gray-600">Active Users</span>
                    <span class="font-semibold text-gray-900">{{ $performanceMetrics['active_users'] }}</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-gray-600">Page Views</span>
                    <span class="font-semibold text-gray-900">{{ $performanceMetrics['page_views'] }}</span>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 bg-white rounded-lg shadow-sm p-6">
            <h4 class="text-lg font-semibold text-gray-900 mb-4">Recent Activities</h4>
            <div class="space-y-4 max-h-96 overflow-y-auto">
                @foreach($recentActivities as $activity)
                    <div class="flex items-center py-3 border-b border-gray-100 last:border-0">
                        <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-{{ $activity['type'] === 'industry' ? 'industry' : ($activity['type'] === 'service' ? 'shield-alt' : ($activity['type'] === 'testimonial' ? 'comments' : 'map-marker-alt')) }} text-red-500"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-gray-900">
                                <span class="font-semibold">{{ ucfirst($activity['type']) }}</span>
                                {{ $activity['action'] }}: {{ $activity['title'] }}
                            </p>
                            <span class="text-sm text-gray-500">{{ $activity['time'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Industries Chart
    const industriesCtx = document.getElementById('industriesChart').getContext('2d');
    new Chart(industriesCtx, {
        type: 'doughnut',
        data: {
            labels: @json($industryData['labels']),
            datasets: [{
                data: @json($industryData['data']),
                backgroundColor: [
                    '#EF4444',
                    '#3B82F6',
                    '#F59E0B',
                    '#10B981',
                    '#8B5CF6',
                    '#EC4899'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                }
            },
            cutout: '70%'
        }
    });

    // Services Chart
    const servicesCtx = document.getElementById('servicesChart').getContext('2d');
    new Chart(servicesCtx, {
        type: 'bar',
        data: {
            labels: @json($serviceData['labels']),
            datasets: [{
                label: 'Services Distribution',
                data: @json($serviceData['data']),
                backgroundColor: '#3B82F6',
                borderRadius: 4,
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        drawBorder: false,
                        color: '#E5E7EB'
                    },
                    ticks: {
                        padding: 10
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        padding: 10
                    }
                }
            }
        }
    });
});
</script>
@endpush
@endsection