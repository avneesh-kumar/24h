@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Menus</h1>
        <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Menu Item
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>URL</th>
                            <th>Parent</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($menus as $menu)
                            <tr>
                                <td>{{ $menu->order }}</td>
                                <td>
                                    @if($menu->icon)
                                        <i class="{{ $menu->icon }}"></i>
                                    @endif
                                    {{ $menu->title }}
                                </td>
                                <td>
                                    <span class="badge bg-{{ $menu->type === 'header' ? 'primary' : 'info' }}">
                                        {{ ucfirst($menu->type) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ $menu->url }}" target="_blank" class="text-decoration-none">
                                        {{ Str::limit($menu->url, 30) }}
                                    </a>
                                </td>
                                <td>
                                    @if($menu->parent)
                                        {{ $menu->parent->title }}
                                    @else
                                        <span class="text-muted">None</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $menu->active ? 'success' : 'danger' }}">
                                        {{ $menu->active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this menu item?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No menu items found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $menus->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 