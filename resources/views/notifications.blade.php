@extends('layouts.app')

@section('content')
    <!-- shop section -->

    <section class="shop_section">

        <div class="container">
            <div class="heading_container heading_center mb-4 mt-5">
                <h1> Notifications </h1>
            </div>
            <div>
                @foreach($notifications as $key => $notification)
                    @if(!$notification->checked)
                        <div class="card w-50 mx-auto my-2">
                            <div class="card-header">
                                {{ $notification->notify_for }}
                            </div>
                            <div class="card-body d-flex">
                                <div>
                                    <h5 class="card-title">{{ $notification->details }}</h5>
                                    <p>{{ $notification->created_at }}</p>
                                    <p>{{ $notification->p_name ?? '' }}</p>
                                    <a href="{{ route('notification-check', ['id' => $notification->id]) }}" class="btn btn-primary">Check</a>
                                </div>
                                <div>

                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                    @if(count($notifications) < 1)
                        <div class="card w-25 mx-auto">
                            <div class="card-body" style="font-size: 24px">
                                <i class="fa fa-exclamation-circle text-danger" aria-hidden="true"></i>
                                <span class="font-weight-bold opacity-75">No items found.....</span>
                            </div>
                        </div>
                    @endif
            </div>
        </div>
    </section>

@endsection
