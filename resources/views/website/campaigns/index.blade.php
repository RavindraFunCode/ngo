@extends('layouts.website')

@section('title', 'Causes || Humanity')

@section('content')
    <div class="inner-banner has-base-color-overlay text-center" style="background: url({{ asset('website/images/background/4.jpg') }});">
        <div class="container">
            <div class="box">
                <h1>Causes</h1>
            </div>
        </div>
    </div>

    <div class="breadcumb-wrapper">
        <div class="container">
            <div class="pull-left">
                <ul class="list-inline link-list">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Causes</li>
                </ul>
            </div>
            <div class="pull-right">
                <a class="get-qoute" href="{{ route('volunteer') }}"><i class="fa fa-arrow-circle-right"></i>Become a Volunteer</a>
            </div>
        </div>
    </div>

    <section class="urgent-cause2 sec-padd">
        <div class="container">
            <div class="row">
                @foreach($campaigns as $campaign)
                    <article class="item col-md-4 col-sm-6 col-xs-12">
                        <figure class="img-box">
                            <img src="{{ $campaign->image ? asset('uploads/' . $campaign->image) : asset('website/images/cause/1.jpg') }}" alt="{{ $campaign->title }}">
                            <div class="overlay">
                                <div class="inner-box">
                                    <div class="content-box">
                                        <button class="thm-btn style-2" data-toggle="modal" data-target="#donateModal" data-campaign-id="{{ $campaign->id }}" data-campaign-title="{{ $campaign->title }}">donate now</button>
                                    </div>
                                </div>
                            </div>
                        </figure>
                        <div class="content">
                            <div class="text center">
                                <a href="{{ route('campaigns.show', $campaign->slug) }}"><h4 class="title">{{ $campaign->title }}</h4></a>
                                <p>{{ Str::limit(strip_tags($campaign->description), 100) }}</p>
                            </div>
                            <div class="progress-box">
                                <div class="bar">
                                    <div class="bar-inner animated-bar" data-percent="{{ $campaign->raised_percent }}%"><div class="count-text">{{ $campaign->raised_percent }}%</div></div>
                                </div>
                            </div>
                            <div class="donate clearfix">
                                <div class="donate float_left"><span>Goal: ${{ number_format($campaign->goal_amount) }} </span></div>
                                <div class="donate float_right">Raised: ${{ number_format($campaign->raised_amount) }}</div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="center">
                {{ $campaigns->links() }}
            </div>
        </div>
    </section>

    <!-- Donation Modal -->
    <div class="modal fade" id="donateModal" tabindex="-1" role="dialog" aria-labelledby="donateModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="donateModalLabel">Donate to <span id="modal-campaign-title"></span></h4>
                </div>
                <form action="{{ route('donation.process') }}" method="POST">
                    @csrf
                    <input type="hidden" name="campaign_id" id="modal-campaign-id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="amount">Amount ($)</label>
                            <input type="number" class="form-control" id="amount" name="amount" required min="1" step="0.01">
                        </div>
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                        <div class="form-group">
                            <label for="payment_method">Payment Method</label>
                            <select class="form-control" id="payment_method" name="payment_method">
                                <option value="card">Credit/Debit Card</option>
                                <option value="paypal">PayPal</option>
                                <option value="offline">Offline/Bank Transfer</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary thm-btn">Donate Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $('#donateModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var campaignId = button.data('campaign-id');
            var campaignTitle = button.data('campaign-title');
            var modal = $(this);
            modal.find('#modal-campaign-id').val(campaignId);
            modal.find('#modal-campaign-title').text(campaignTitle);
        });
    </script>
    @endpush
@endsection
