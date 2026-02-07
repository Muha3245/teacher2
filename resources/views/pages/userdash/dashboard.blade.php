@extends('layouts.userdash')

@push('userdashstyles')
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #eef2ff;
            --surface: #ffffff;
            --text-heading: #111827;
            --text-body: #4b5563;
            --text-muted: #9ca3af;
            --border: #f3f4f6;
            --bg-page: #f9fafb;
        }

        .post-feed-container {
            max-width: 900px;
            margin: 0 auto;
        }

        /* The Card - Modern Minimalism */
        .post-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: all 0.2s ease;
            display: flex;
            gap: 2rem;
            position: relative;
        }

        .post-card:hover {
            border-color: #e5e7eb;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.04);
            transform: translateY(-2px);
        }

        /* Left Section: Content */
        .content-main {
            flex: 1;
        }

        .subject-tags {
            display: flex;
            gap: 6px;
            margin-bottom: 0.75rem;
        }

        .subject-pill {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            color: var(--primary);
            background: var(--primary-light);
            padding: 2px 10px;
            border-radius: 4px;
        }

        .post-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-heading);
            line-height: 1.5;
            margin-bottom: 1rem;
        }

        /* Middle Meta Bar */
        .meta-grid {
            display: flex;
            flex-wrap: wrap;
            column-gap: 1.5rem;
            row-gap: 0.5rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border);
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: var(--text-body);
            font-weight: 500;
        }

        .meta-item i {
            color: var(--text-muted);
            width: 16px;
        }

        /* Right Section: Budget & Actions */
        .side-info {
            width: 160px;
            border-left: 1px solid var(--border);
            padding-left: 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: right;
        }

        .budget-amount {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-heading);
            display: block;
            line-height: 1;
        }

        .budget-label {
            font-size: 12px;
            color: var(--text-muted);
            text-transform: uppercase;
            font-weight: 600;
            margin-top: 4px;
        }

        .language-container {
            margin-top: 0.5rem;
            display: flex;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 4px;
        }

        .lang-tag {
            font-size: 10px;
            background: #f3f4f6;
            color: #374151;
            padding: 1px 6px;
            border-radius: 3px;
            border: 1px solid #e5e7eb;
        }

        /* Dropdown custom */
        .action-btn {
            background: none;
            border: none;
            color: var(--text-muted);
            padding: 4px;
            border-radius: 6px;
            transition: 0.2s;
        }

        .action-btn:hover {
            background: #f3f4f6;
            color: var(--text-heading);
        }

        @media (max-width: 768px) {
            .post-card {
                flex-direction: column;
                gap: 1rem;
            }

            .side-info {
                width: 100%;
                border-left: none;
                padding-left: 0;
                border-top: 1px solid var(--border);
                padding-top: 1rem;
                text-align: left;
            }

            .language-container {
                justify-content: flex-start;
            }
        }
    </style>
@endpush

@section('content')

    @php
        // These calls should ideally be in your Controller
        $yourposts = SingleStudentPost(auth()->id());
    @endphp
    <div class="container py-5">
        <div class="post-feed-container">

            {{-- Header Section --}}
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <h2 class="fw-bold text-dark mb-1">My Requests</h2>
                    <p class="text-muted small mb-0">You have <strong>{{ $yourposts->count() }}</strong> active listings</p>
                </div>
                <a href="{{ route('user.createpost') }}" class="btn btn-primary px-4 py-2 rounded-3 fw-bold shadow-sm">
                    + New Request
                </a>
            </div>

            @forelse($yourposts as $post)
                <div class="post-card">
                    <div class="content-main">
                        <div class="subject-tags">
                            @foreach (json_decode($post->subjects ?? '[]') as $subject)
                                <span class="subject-pill">{{ $subject }}</span>
                            @endforeach
                        </div>

                        <h3 class="post-title">{{ $post->description }}</h3>

                        <div class="meta-grid">
                            <div class="meta-item">
                                <i data-lucide="map-pin" size="14"></i>
                                {{ $post->location ?? 'Online' }}
                            </div>
                            <div class="meta-item">
                                <i data-lucide="graduation-cap" size="14"></i>
                                {{ $post->levelText ?? 'All Levels' }}
                            </div>
                            <div class="meta-item">
                                <i data-lucide="users" size="14"></i>
                                {{ $post->genderPreference ?? 'Any Gender' }}
                            </div>
                            <div class="meta-item">
                                <i data-lucide="clock" size="14"></i>
                                {{ $post->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>

                    <div class="side-info">
                        <div class="d-flex justify-content-between align-items-start w-100">
                            <div class="language-container order-2 order-md-1">
                                @foreach (json_decode($post->language ?? '[]') as $lan)
                                    <span class="lang-tag">{{ $lan }}</span>
                                @endforeach
                            </div>

                            <div class="dropdown"> <button class="action-btn" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false"> <i data-lucide="more-horizontal"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2 rounded-3"
                                    style="min-width: 180px;">
                                    <li>
                                        <a class="dropdown-item rounded-2 d-flex align-items-center gap-2 py-2"
                                            href="{{ route('student.post.show', $post->id) }}">
                                            <i data-lucide="eye" size="14"></i> <span>View Post</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item rounded-2 d-flex align-items-center gap-2 py-2"
                                            href="{{ route('student.post.edit', $post->id) }}">
                                            <i data-lucide="edit-3" size="14"></i> <span>Edit Request</span>
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider opacity-50">
                                    </li>
                                    <li>
                                        <a class="dropdown-item rounded-2 d-flex align-items-center gap-2 py-2 text-danger"
                                            href="#">
                                            <i data-lucide="trash-2" size="14"></i> <span>Delete Post</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div>
                            <span class="budget-amount">${{ number_format($post->budget, 0) }}</span>
                            <span class="budget-label">{{ $post->budgetType }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 border rounded-4 bg-white shadow-sm">
                    <p class="text-muted">No posts found. Start by creating one!</p>
                </div>
            @endforelse


        </div>
    </div>
@endsection
