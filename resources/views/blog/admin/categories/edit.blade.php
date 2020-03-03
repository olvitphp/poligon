<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<body>


@extends('layouts.app')

@section('content')

    @php /** @var \App\Models\BlogCategory $item */ @endphp

    @if($item->exists)

        <form method="POST" action="{{ route('blog.admin.categories.update', $item->id) }}">
    @method('PATCH')
        @else
            <form method="POST" action="{{ route('blog.admin.categories.store') }}">
        @endif
        @csrf

    <div class="container">
        @php
        /** @var \Illuminate\Support\ViewErrorBag $errors */
        @endphp

        @if($errors->any())
            <div class="row justify-content-center">
                <div class="col-md-11">
                       <div class="alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                </button>
                           {{$errors->first()}}

                      </div>
                </div>
            </div>
        @endif
        @if(session('success'))
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                        {{session()->get('success')}}

                    </div>

                </div>

            </div>

        @endif

    <div class="row justify-content-center">
    <div class="col-md-8">
    @include('blog.admin.categories.includes.item_edit_main_col')
    </div>
    <div class="col-md-3">
    @include('blog.admin.categories.includes.item_edit_add_col')

                 </div>
           </div>
    </div>
    </form>


@endsection
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
