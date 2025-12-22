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
                <div class="col-md-8 col-md-offset-2">
                    <div class="default-form-area login-form-area text-center">
                        <h2>Confirm Your Donation</h2>
                        <div class="table-responsive" style="margin-top: 30px; margin-bottom: 30px;">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th width="30%">Name</th>
                                        <td>{{ $data['name'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $data['email'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $data['phone'] }}</td>
                                    </tr>
                                    @if(!empty($data['address']))
                                    <tr>
                                        <th>Address</th>
                                        <td>{{ $data['address'] }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th>Amount</th>
                                        <td>{{ $data['currency_symbol'] }}{{ $data['amount'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Payment Method</th>
                                        <td>
                                            @if($data['payment_method'] == 'credit_card')
                                                Credit Card
                                            @elseif($data['payment_method'] == 'paypal')
                                                PayPal
                                            @else
                                                Offline Donation
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <form action="{{ route('donation.process') }}" method="POST">
                            @csrf
                            <input type="hidden" name="name" value="{{ $data['name'] }}">
                            <input type="hidden" name="email" value="{{ $data['email'] }}">
                            <input type="hidden" name="phone" value="{{ $data['phone'] }}">
                            <input type="hidden" name="address" value="{{ $data['address'] }}">
                            <input type="hidden" name="amount" value="{{ $data['amount'] }}">
                            <input type="hidden" name="currency" value="{{ $data['currency'] }}">
                            <input type="hidden" name="payment_method" value="{{ $data['payment_method'] }}">
                            
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
