@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Categoriën overzicht</div>

                <div class="panel-body">
                    @foreach ($categories as $category)
                        <span class="badge badge-success"><a href="{{ route('search', [$category->name]) }}">{{ $category->name }}</a></span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
