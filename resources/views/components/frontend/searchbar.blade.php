@php
    $teacherprofile = TeacherProfile();
    $teachersubjects = TeacherSubjects();
@endphp
<div class="container py-5">
    <form action="{{ route('search.teachers') }}" method="GET" class="search-bar-wrapper">
        <div class="search-bar">
            <select name="subject" class="search-input left">
                <option value="">Select Subject</option>
                @foreach ($teachersubjects as $subject)
                    <option value="{{ $subject->subject->name }}"
                        {{ request('subject') == $subject->subject->name ? 'selected' : '' }}>
                        {{ $subject->subject->name }}
                    </option>
                @endforeach
            </select>

            <span class="divider">|</span>

            <input type="text" name="location" class="search-input right" placeholder="Search location"
                value="{{ request('location') }}">

            <button type="submit" class="search-btn">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>
    @if ($tags ?? false)
        <ul class="search-tags">
            <li class="active" data-type="all">All</li>
            <li data-type="online" >online</li>
            <li data-type="home">home</li>
            <li data-type="assignment">Assignment</li>
        </ul>
    @endif

</div>



<style>
    .search-bar-wrapper {
        width: 100%;
        max-width: 700px;
        margin: 0 auto 2rem;
    }

    .search-bar {
        display: flex;
        align-items: center;
        background: #ffffff;
        border-radius: 999px;
        border: 1px solid #e5e7eb;
        padding: 6px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    }

    .search-input {
        border: none;
        outline: none;
        padding: 14px 16px;
        font-size: 0.95rem;
        width: 100%;
        background: transparent;
        color: #374151;
    }

    .search-input.left {
        border-radius: 999px 0 0 999px;
    }

    .search-input.right {
        border-radius: 0 999px 999px 0;
    }

    .search-bar select {
        appearance: none;
        background: transparent;
        width: 100%;
        cursor: pointer;
    }

    .search-btn {
        background: #4f46e5;
        border: none;
        color: white;
        padding: 12px 18px;
        border-radius: 999px;
        margin-left: 6px;
        cursor: pointer;
        transition: 0.2s;
    }

    .search-btn:hover {
        background: #4338ca;
    }

    /* ===== Search Tags ===== */
    .search-tags {
        display: flex;
        gap: 10px;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 14px;
        padding: 0;
    }

    .search-tags li {
        list-style: none;
        background: #eef2ff;
        color: #3730a3;
        padding: 8px 16px;
        border-radius: 999px;
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.15);
    }

    /* Hover effect */
    .search-tags li:hover {
        background: #4f46e5;
        color: #ffffff;
        transform: translateY(-1px);
    }

    /* Active / selected tag (optional) */
    .search-tags li.active {
        background: #4f46e5;
        color: #ffffff;
        box-shadow: 0 6px 14px rgba(79, 70, 229, 0.35);
    }
</style>

