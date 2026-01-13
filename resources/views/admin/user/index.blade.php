@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-people-fill me-2"></i> All Users</h5>
            {{-- <a href="#" class="btn btn-light btn-sm d-flex align-items-center">
                <i class="bi bi-plus-circle me-1"></i> Add New
            </a> --}}
        </div>

        <!-- Box Body -->
        <div class="card-body box-body bg-white">
            <div class="table-responsive">
                <table class="table table-hover align-middle border">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Person</th>
                            <th>Joined</th>
                            <th>Verified</th>
                            <th>Status</th>
                            <th>Block</th>
                            {{-- <th>IP</th> --}}
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                            <tr class="{{ $user->is_blocked ? 'table-danger' : '' }}">
                                <td>{{ $index + 1}}</td>
                                <td class="fw-semibold">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->person)
                                        <span class="badge bg-info">{{ ucfirst($user->person) }}</span>
                                    @else
                                        <span class="badge bg-secondary">No Role</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                <td>
                                    @if($user->email_verified_at)
                                        <span class="badge bg-success">Verified</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Not Verified</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($user->is_blocked)
                                        <span class="badge bg-danger">Blocked</span>
                                    @else
                                        <span class="badge bg-success">Active</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="#" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="btn btn-sm {{ $user->is_blocked ? 'btn-success' : 'btn-outline-danger' }}">
                                            <i class="bi {{ $user->is_blocked ? 'bi-unlock' : 'bi-lock-fill' }}"></i>
                                        </button>
                                    </form>
                                </td>
                                {{-- <td>{{ session('ip_address') ?? 'N/A' }}</td> --}}
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary btn-sm rounded-circle" type="button"
                                            id="dropdownMenuButton{{ $user->id }}" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm"
                                            aria-labelledby="dropdownMenuButton{{ $user->id }}">
                                            <li>
                                                <a class="dropdown-item text-info" href="#">
                                                    <i class="bi bi-eye me-2"></i> View
                                                </a>
                                            </li>
                                            {{-- <li>
                                                <a class="dropdown-item text-warning" href="#">
                                                    <i class="bi bi-pencil-square me-2"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <form action="#" method="POST" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item text-danger" type="submit">
                                                        <i class="bi bi-trash me-2"></i> Delete
                                                    </button>
                                                </form>
                                            </li> --}}
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted py-4">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            {{-- <div class="d-flex justify-content-end mt-3">
                {{ $users->links('pagination::bootstrap-5') }}
            </div> --}}
        </div>
    </div>
</div>

@push('adminstyles')
    <style>
        .box-body {
            padding: 1.5rem;
            border-radius: 0 0 0.375rem 0.375rem;
        }

        .card-header {
            border-radius: 0.375rem 0.375rem 0 0;
        }

        .table thead th {
            white-space: nowrap;
        }
    </style>
@endpush

@endsection
