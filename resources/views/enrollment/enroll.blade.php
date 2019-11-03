@extends('layouts.main')

@section('content')
<div class="whole-wrap">
    <div class="container box_1170">
        <div class="section-top-border">
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <h3 class="mb-30">Submit an application for course enrollment</h3>
                    @guest
                        <p>If you have account, login with your credentials <a href="{{ route('enroll.handleLogin', $course->id) }}">here</a>.</p>
                    @endguest
                    <form method="POST" action="{{ route('enroll.store', $course->id) }}">
                        @csrf
                        <div class="mt-10">
                            <input type="text" name="name" placeholder="Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'"
                             required class="single-input" value="{{ auth()->check() ?  auth()->user()->name : old('name') }}" @auth disabled @endauth>
                        </div>
                        <div class="mt-10">
                            <input type="email" name="email" placeholder="Email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'"
                             required class="single-input" value="{{ auth()->check() ?  auth()->user()->email : old('email') }}" @auth disabled @endauth>
                        </div>
                        @guest
                            <div class="mt-10">
                                <input type="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'"
                                required class="single-input">
                            </div>
                            <div class="mt-10">
                                <input type="password" name="password_confirmation" placeholder="Confirm Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'"
                                required class="single-input">
                            </div>
                        @endguest
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <div class="mt-10 pull-right">
                            <input type="submit" class="genric-btn primary" name="submit" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection