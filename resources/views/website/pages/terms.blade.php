@extends('layouts.website')

@section('content')
    <div class="inner-banner has-base-color-overlay text-center" style="background: url({{ asset('website/images/background/4.jpg') }});">
        <div class="container">
            <div class="box">
                <h1>Terms & Conditions</h1>
            </div>
        </div>
    </div>
    <div class="breadcumb-wrapper">
        <div class="container">
            <div class="pull-left">
                <ul class="list-inline link-list">
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>
                        Terms & Conditions
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <section class="sec-padd">
        <div class="container">
            <div class="text">
                <h3>Terms & Conditions</h3>
                <p>Last updated: November 29, 2025</p>
                <p>Please read these terms and conditions carefully before using Our Service.</p>
                
                <h4>Interpretation and Definitions</h4>
                <p>The words of which the initial letter is capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.</p>
                
                <h4>Acknowledgment</h4>
                <p>These are the Terms and Conditions governing the use of this Service and the agreement that operates between You and the Company. These Terms and Conditions set out the rights and obligations of all users regarding the use of the Service.</p>
                
                <h4>Contact Us</h4>
                <p>If you have any questions about these Terms and Conditions, You can contact us:</p>
                <ul>
                    <li>By email: terms@humanity.org</li>
                </ul>
            </div>
        </div>
    </section>
@endsection
