@extends('layouts.admin.app')

@section('content')
    <!-- shop section -->

    <section class="shop_section">

        <div class="container">
            <nav class="navbar bg-light">
                <div class="container-fluid">
                    <form class="d-flex" role="search" method="GET" action="{{ route('admin.user') }}">
                        <select name="category" class="form-select mx-2" aria-label="Default select example">
                            <option value="" selected>All</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                        <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" value="{{ request()->input('search') }}">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </nav>
            <div class="heading_container heading_center mb-4 mt-5">
                <strong style="font-size: 16px" class="text-decoration-underline"> Users History </strong>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User Profile</th>
                    <th scope="col">Status</th>
                    <th scope="col">Uploaded <br> Product Count</th>
                    <th scope="col">Purchased <br> Product Count</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $key => $user)
                    <tr>
                        <th>
                            {{ $key+1 }}
                        </th>
                        <td>
                            <h5 class="block">{{ $user->name }}</h5>
                            <strong class="font-weight-bold d-inline-block">{{ $user->email }}</strong><br>
                            <small class="badge rounded-pill bg-primary">{{ $user->type }}</small><br>

                        </td>
                        <td>
                            {{ $user->status }}
                        </td>
                        <td>
                            {{ $user->products_author_count }}
                        </td>
                        <td>
                            {{ $user->products_buyer_count }}
                        </td>
                        <td>
                                @if($user->status == 'Active')
                                    <button type="button" class="btn btn-sm my-1 btn-outline-primary">
                                        <a href="{{ route('admin.user.update', ['id' => $user->id, 'status' => 'Inactive']) }}">Deactivate</a>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm my-1 btn-outline-primary">
                                        <a href="{{ route('admin.user.update', ['id' => $user->id, 'status' => 'Active']) }}">Active</a>
                                    </button>
                                @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div style="height: 50px">
                {{ $users->links() }}
            </div>
            <div class="row">
                @if(count($users) < 1)
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
