@extends('layouts.website')

@section('title', 'Thank You || Humanity')

@section('content')
    <div class="inner-banner has-base-color-overlay text-center" style="background: url({{ asset('website/images/background/4.jpg') }});">
        <div class="container">
            <div class="box">
                <h1>Thank You</h1>
            </div>
        </div>
    </div>

    <section class="sec-padd text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="section-title center">
                        <h2>Thank You for Your <span class="thm-color">Donation!</span></h2>
                    </div>
                    <div class="text">
                        <p>Your generous donation has been received. We appreciate your support for our cause.</p>
                        <br>
                        <a href="{{ route('home') }}" class="thm-btn">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
