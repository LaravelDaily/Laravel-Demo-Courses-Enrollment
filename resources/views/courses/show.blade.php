@extends('layouts.main')

@section('content')

<section class="course_details_area section_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 course_details_left">
                <div class="main_image">
                    <img class="img-fluid" src="{{ optional($course->photo)->getUrl() ?? asset('img/no_image.png') }}" alt="">
                </div>
                <div class="content_wrapper">
                    <h4 class="title_top">Description</h4>
                    <div class="content">
                        {{ $course->description ?? 'No description provided' }}
                    </div>
                </div>
            </div>


            <div class="col-lg-4 right-contents">
                <div class="sidebar_top">
                    <ul>
                        @if($course->institution)
                            <li>
                                <a class="justify-content-between d-flex">
                                    <p>Institution</p>
                                    <span class="color">{{ $course->institution->name }}</span>
                                </a>
                            </li>
                        @endif
                        <li>
                            <a class="justify-content-between d-flex">
                                <p>Course Fee </p>
                                <span>{{ $course->getPrice() }}</span>
                            </a>
                        </li>

                    </ul>
                    <a href="{{ route('enroll.create', $course->id) }}" class="btn_1 d-block">Enroll the course</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection