@extends('layouts.app')

@section('content')
<div class="container w-100 d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card w-auto">
        @if($errors->any())
            @foreach($errors->all() as $message)
                <div class="position-fixed w-25" style="top: 30rem; right: 20px;">
                    <div class="alert alert-danger"> {{ $message }} </div>
                </div>
            @endforeach
        @endif
        <div class="card-body">
            <h4 class="card-title text-center" style="font-weight: bold;">Login</h4>
            <form method="post" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="checked" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
