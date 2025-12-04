@extends('layouts.website')

@section('content')
    <div class="inner-banner has-base-color-overlay text-center" style="background: url({{ asset('website/images/background/4.jpg') }});">
        <div class="container">
            <div class="box">
                <h1>Privacy Policy</h1>
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
                        Privacy Policy
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <section class="sec-padd">
        <div class="container">
            <div class="text">
                <h3>Privacy Policy</h3>
                <p>Last updated: November 29, 2025</p>
                <p>This Privacy Policy describes Our policies and procedures on the collection, use and disclosure of Your information when You use the Service and tells You about Your privacy rights and how the law protects You.</p>
                
                <h4>Collecting and Using Your Personal Data</h4>
                <p>We collect several different types of information for various purposes to provide and improve our Service to you.</p>
                
                <h4>Types of Data Collected</h4>
                <p><strong>Personal Data</strong></p>
                <p>While using Our Service, We may ask You to provide Us with certain personally identifiable information that can be used to contact or identify You. Personally identifiable information may include, but is not limited to:</p>
                <ul>
                    <li>Email address</li>
                    <li>First name and last name</li>
                    <li>Phone number</li>
                    <li>Address, State, Province, ZIP/Postal code, City</li>
                </ul>
                
                <h4>Contact Us</h4>
                <p>If you have any questions about this Privacy Policy, You can contact us:</p>
                <ul>
                    <li>By email: privacy@humanity.org</li>
                </ul>
            </div>
        </div>
    </section>
@endsection
