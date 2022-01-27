@extends('layouts.main')
@section('content')
    <div class="container">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="row text-center">
            <h1 class="my-4">Clients table</h1>
            <div class="col-12">
                <form action="{{route('search')}}" method="GET">
                    @csrf
                    <div class="row">
                        <div class="col-md-11">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control" id="exampleInputEmail1"  placeholder="Enter text">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12">
                <table class="table table-bordered mt-4">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Manager</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td>{{$client->id}}</td>
                            <td>{{$client->name}}</td>
                            <td>{{$client->email}}</td>
                            <td>{{$client->manager->name ?? '' }}</td>
                            <td>
                                <a href="{{route('edit', $client->id)}}"><button class="btn btn-sm btn-success">Edit</button></a>
                            </td>
                            <td>
                                <form action="{{route('delete', $client->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $clients->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
@endsection
