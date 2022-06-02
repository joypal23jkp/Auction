@extends('layouts.app')

@section('content')
<div class="container w-100 d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card w-auto">
        @if($errors->any())
            @foreach($errors->all() as $message)
                <div class="position-fixed w-50" style="top: 30rem; right: 20px;">
                    <div class="alert alert-danger"> {{ $message }} </div>
                </div>
            @endforeach
        @endif

        <div class="card-body">
                    <h4 class="card-title text-center" style="font-weight: bold;">{{ __('Register') }}</h4>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="confirm_password">
                        </div>

                        <div class=" mb-0">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Register') }}
                                </button>
                        </div>
                    </form>
                </div>
    </div>
</div>
@endsection
