@extends('layouts.website')

@section('title', 'Checkout || Humanity')

@section('content')
    <div class="inner-banner has-base-color-overlay text-center" style="background: url({{ asset('website/images/background/4.jpg') }});">
        <div class="container">
            <div class="box">
                <h1>Donation Checkout</h1>
            </div>
        </div>
    </div>

    <section class="checkout-section sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-sm-12">
                    <div class="section-title center">
                        <h2>Review Your <span class="thm-color">Donation</span></h2>
                    </div>
                    <div class="default-form-area">
                        <form action="{{ route('donation.process') }}" method="POST" class="default-form">
                            @csrf
                            <input type="hidden" name="amount" value="{{ $data['amount'] }}">
                            <input type="hidden" name="name" value="{{ $data['name'] }}">
                            <input type="hidden" name="email" value="{{ $data['email'] }}">
                            
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $data['name'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $data['email'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Amount</th>
                                            <td>${{ $data['amount'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Method</th>
                                            <td>{{ ucfirst(str_replace('_', ' ', $data['payment_method'])) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="center">
                                <button class="thm-btn" type="submit">Confirm Donation</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
