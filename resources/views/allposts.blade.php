
@extends('layouts.frontend')

@push('frontendstyles')
    <style>
        /* ===== Layout Container ===== */
        .posts {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            padding: 2rem;
            max-width: 850px;
            margin: 0 auto;
        }

        .card {
            background: #ffffff;
            width: 100%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 20px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .card-name {
            color: #3498db;
            font-size: 1.6rem;
            font-weight: 500;
            margin-bottom: 12px;
            display: block;
            text-decoration: none;
        }

        /* 2. The Subject Tag (Bordered Box) */
        .subject-list {
            display: flex;
            gap: 10px;
            padding: 0;
            margin: 0 0 15px 0;
            list-style: none;
        }

        .subject-list li {
            border: 1px solid #dcdcdc;
            /* Light grey border like the pic */
            color: #666;
            font-size: 0.9rem;
            padding: 6px 12px;
            border-radius: 2px;
            background: #fff;
        }

        /* 3. The Description */
        .card-desc {
            color: #444;
            font-size: 1.05rem;
            line-height: 1.6;
            margin-bottom: 20px;
            display: block;
        }

        /* 4. Stats Row (Icons) */
        .card-stats {
            display: flex;
            gap: 25px;
            padding: 0;
            margin: 0;
            list-style: none;
            flex-wrap: wrap;
        }

        .card-stats li {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #555;
            font-size: 1rem;
        }

        /* Icons styling - Dark Grey like the image */
        .card-stats li i {
            color: #444;
            font-size: 1.2rem;
        }

        /* Mobile View Adjustment */
        @media (max-width: 600px) {
            .card-stats {
                gap: 15px;
            }

            .card-stats li {
                font-size: 0.9rem;
            }
        }
    </style>
@endpush

@section('content')
    <x-frontend.navbar />
    <x-frontend.searchbar :tags="true" />

    <section class="posts" id="teacher-container">

        @foreach ($teacherprofile as $teacher)
            <div class="card">
                <a href="#" class="card-name">{{ $teacher->full_name }}</a>

                <ul class="subject-list">
                    @foreach ($teacher->subjects->take(3) as $sub)
                        <li>{{ $sub->subject->name }}</li>
                    @endforeach
                </ul>

                <div class="card-desc">
                    {{ $teacher->profile_description }}
                </div>

                <ul class="card-stats">
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $teacher->location }}
                    </li>
                    <li>
                        <i class="fas fa-dollar-sign"></i>
                        ${{ $teacher->min_price }}/hour
                    </li>
                    <li>
                        <i class="fas fa-laptop"></i>
                        {{ $teacher->years_online }} yr.
                    </li>
                    <li>
                        <i class="fas fa-chalkboard-teacher"></i>
                        {{ $teacher->years_teaching }} yr.
                    </li>
                </ul>
            </div>
        @endforeach
    </section>
@endsection

@push('frontendscripts')
    <script>
        $(document).ready(function() {
            $('.search-tags li').on('click', function() {
                let tagType = $(this).data('type');
                let $container = $('#teacher-container');
                $('.search-tags li').removeClass('active');
                $(this).addClass('active');
                $container.css('opacity', '0.5');

                $.ajax({
                    url: "{{ route('search.teachersposts') }}",
                    type: "GET",
                    data: {
                        tag: tagType,
                    },
                    success: function(response) {
                        $('#teacher-container').html(
                            $(response).find('#teacher-container').html()
                        );
                        $container.css('opacity', '1');
                    },
                    error: function() {
                        alert('Something went wrong. Please try again.');
                        $container.css('opacity', '1');
                    }
                });
            });
        });
    </script>
@endpush
