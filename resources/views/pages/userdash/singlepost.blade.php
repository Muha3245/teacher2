@extends('layouts.userdash')

@push('userdashstyles')
    <style>
        :root {
            --primary: #4f46e5;
            --surface: #ffffff;
            --text-main: #111827;
            --text-muted: #6b7280;
            --border-light: #f3f4f6;
            --bg-page: #f9fafb;
        }

        .page-header-nav {
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Main Content Card */
        .detail-wrapper {
            background: var(--surface);
            border: 1px solid var(--border-light);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .content-section {
            padding: 2.5rem;
        }

        .sidebar-section {
            background: #fafafa;
            border-left: 1px solid var(--border-light);
            padding: 2.5rem;
            height: 100%;
        }

        /* Elements */
        .badge-subject {
            background: #eef2ff;
            color: var(--primary);
            font-weight: 700;
            font-size: 12px;
            padding: 4px 12px;
            border-radius: 6px;
            text-transform: uppercase;
        }

        .post-title-large {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -0.025em;
            margin-top: 1rem;
            line-height: 1.2;
        }

        .description-text {
            font-size: 1.1rem;
            line-height: 1.7;
            color: #374151;
            margin: 2rem 0;
        }

        /* Sidebar Meta */
        .meta-group {
            margin-bottom: 2rem;
        }

        .meta-label {
            font-size: 11px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: block;
            margin-bottom: 0.5rem;
        }

        .meta-value {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Comments System */
        .comment-section-wrapper {
            margin-top: 3rem;
            max-width: 800px;
        }

        .comment-card {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            position: relative;
        }

        .avatar {
            width: 40px;
            height: 40px;
            background: #e5e7eb;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .comment-content {
            flex-grow: 1;
            background: #fff;
            padding: 1rem;
            border-radius: 12px;
            border: 1px solid var(--border-light);
        }

        .comment-author {
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 2px;
        }

        .comment-time {
            font-size: 12px;
            color: var(--text-muted);
        }

        .comment-text {
            font-size: 14px;
            color: #4b5563;
            margin-top: 0.5rem;
        }

        /* Nesting Logic */
        .reply-wrapper {
            margin-left: 3.5rem;
            border-left: 2px solid #f3f4f6;
            padding-left: 1.5rem;
        }

        .action-link {
            font-size: 12px;
            font-weight: 600;
            color: var(--primary);
            text-decoration: none;
            margin-top: 0.75rem;
            display: inline-block;
        }
    </style>
@endpush

@section('content')
    <div class="container py-5">

        {{-- Breadcrumbs / Nav --}}
        <div class="page-header-nav">
            <a href="{{ route('user.dashboard') }}"
                class="text-muted text-decoration-none small d-flex align-items-center gap-2">
                <i data-lucide="arrow-left" size="16"></i> Back to Feed
            </a>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-secondary btn-sm px-3 rounded-pill">Archive</button>
                <a href="{{ route('student.post.edit', $post->id) }}" class="btn btn-primary btn-sm px-4 rounded-pill">Edit
                    Post</a>
            </div>
        </div>

        <div class="detail-wrapper">
            <div class="row g-0">

                {{-- Left Side: Main Content --}}
                <div class="col-lg-8">
                    <div class="content-section">
                        <div class="d-flex gap-2">
                            @foreach (json_decode($post->subjects ?? '[]') as $subject)
                                <span class="badge-subject">{{ $subject }}</span>
                            @endforeach
                        </div>

                        <h1 class="post-title-large">{{ $post->description }}</h1>

                        <div class="description-text">
                            {{-- Assuming you have a longer content field, otherwise using description --}}
                            <p>I am looking for a professional tutor to help me master the core concepts of this subject. My
                                goal is to achieve a deep understanding of the practical applications and prepare for
                                upcoming assessments.</p>
                            <p>Key areas I'd like to focus on include foundational theories, problem-solving techniques, and
                                advanced case studies.</p>
                        </div>

                        @if ($post->files)
                            <div
                                class="mt-4 p-3 border rounded-3 d-flex align-items-center justify-content-between bg-light">
                                <div class="d-flex align-items-center gap-3">
                                    <i data-lucide="file-text" class="text-primary"></i>
                                    <div>
                                        <div class="fw-bold small">{{ $post->files }}</div>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/student_files/' . $post->files)}}" class="btn btn-white btn-sm border shadow-sm">Download</a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Right Side: Sidebar Meta --}}
                <div class="col-lg-4">
                    <div class="sidebar-section">
                        <div class="meta-group">
                            <span class="meta-label">Total Budget</span>
                            <div class="d-flex align-items-baseline gap-1">
                                <span class="h2 fw-bold mb-0">${{ number_format($post->budget, 0) }}</span>
                                <span class="text-muted small">/{{ $post->budgetType }}</span>
                            </div>
                        </div>

                        <div class="meta-group">
                            <span class="meta-label">Location & Type</span>
                            <div class="meta-value">
                                <i data-lucide="map-pin" size="18"></i>
                                {{ $post->location ?? 'Online / Remote' }}
                            </div>
                        </div>

                        <div class="meta-group">
                            <span class="meta-label">Expertise Level</span>
                            <div class="meta-value">
                                <i data-lucide="bar-chart-3" size="18"></i>
                                {{ $post->levelText ?? 'Beginner to Intermediate' }}
                            </div>
                        </div>

                        <div class="meta-group">
                            <span class="meta-label">Languages</span>
                            <div class="d-flex flex-wrap gap-1 mt-2">
                                @foreach (json_decode($post->language ?? '[]') as $lan)
                                    <span class="badge border bg-white text-dark fw-medium">{{ $lan }}</span>
                                @endforeach
                            </div>
                        </div>

                        <hr class="my-4 opacity-50">

                        <div class="meta-group">
                            <span class="meta-label">Gender Preference</span>
                            <div class="meta-value">
                                <i data-lucide="user-check" size="18"></i>
                                {{ $post->genderPreference ?? 'No Preference' }}
                            </div>
                        </div>

                        <div class="meta-group">
                            <span class="meta-label">Posted On</span>
                            <div class="meta-value text-muted small">
                                {{ $post->created_at->format('M d, Y • h:i A') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Comments Section --}}
        <div class="comment-section-wrapper">
            <h4 class="fw-bold mb-4">Tutor Proposals & Comments (3)</h4>

            @foreach ($post->comments as $comment)
                <div class="comment-card">
                    <div class="avatar"></div>
                    <div class="comment-content">
                        <div class="d-flex justify-content-between">
                            <span class="comment-author">{{ $comment->user->name }}</span>
                            <span class="comment-time">{{ $comment->created_at->format('M d, Y • h:i A') }}</span>
                        </div>
                        <div class="comment-text">
                            {{ $comment->content }}
                        </div>
                        <a href="javascript:void(0)" class="action-link" onclick="toggleReplyForm({{ $comment->id }})">
                            Reply
                        </a>
                        <form action="{{ route('comments.reply', ['comment' => $comment->id]) }}" method="POST"
                            class="mt-3 d-none" id="reply-form-{{ $comment->id }}">
                            @csrf
                            <input type="hidden" name="parant_id" value="{{ $comment->user_id }}">
                            <textarea name="content" class="form-control rounded-3" rows="2" placeholder="Write your reply..."></textarea>

                            <button type="submit" class="btn btn-sm btn-primary mt-2 rounded-pill">
                                Reply
                            </button>
                        </form>
                    </div>
                </div>
                @if ($comment->replies->count() > 0)
                    @foreach ($comment->replies as $reply)
                        <div class="reply-wrapper">
                            <div class="comment-card">
                                <div class="avatar"
                                    style="background: #4f46e520; color: #4f46e5; display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:bold;">
                                    ME</div>
                                <div class="comment-content" style="background: #f8fafc;">
                                    <div class="d-flex justify-content-between">
                                        <span class="comment-author">{{ $reply->user->name }}</span>
                                        <span
                                            class="comment-time">{{ $reply->created_at->format('M d, Y • h:i A') }}</span>
                                    </div>
                                    <div class="comment-text">
                                        {{ $reply->content }}
                                    </div>
                                    <a href="javascript:void(0)" class="action-link"
                                        onclick="toggleReplyForm('reply-{{ $reply->id }}')">
                                        Reply
                                    </a>

                                    <form action="{{ route('comments.reply', $reply->id) }}" method="POST"
                                        class="mt-3 d-none" id="reply-form-reply-{{ $reply->id }}">
                                        @csrf
                                        <input type="hidden" name="parant_id" value="{{ $comment->user_id }}">
                                        <textarea name="content" class="form-control rounded-3" rows="2" placeholder="Write your reply..."></textarea>

                                        <button type="submit" class="btn btn-sm btn-primary mt-2 rounded-pill">
                                            Reply
                                        </button>
                                    </form>


                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endforeach






            {{-- Add Comment Box --}}
            <div class="mt-5">
                <label class="fw-bold mb-2">Leave a comment</label>
                <form action="{{ route('jobs.comment', $post->id) }}" method="post">
                    @csrf
                    <textarea name="comment" class="form-control border-0 shadow-sm rounded-3" rows="3"
                        placeholder="Write your message here..." style="background: #fff; border: 1px solid #e5e7eb !important;"></textarea>
                    <button type="submit" class="btn btn-primary mt-3 px-4 rounded-pill fw-bold">Post Comment</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('userdashjs')
<script>
    function toggleReplyForm(key) {
        const form = document.getElementById('reply-form-' + key);
        if (form) {
            form.classList.toggle('d-none');
        }
    }
</script>
@endpush

