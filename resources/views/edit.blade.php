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

        <div class="row">
            <h1 class="my-4">Edit Page</h1>
            <div class="col-12">
                <form action="{{route('update', $user->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="name"  placeholder="Name" value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email"  placeholder="Enter email" value="{{$user->email}}">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                </form>
                @if($errors->any())
                    <div class="mt-2">
                        @foreach ($errors->all() as $error)
                            <div class="text-danger"> - {{ $error }}</div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
