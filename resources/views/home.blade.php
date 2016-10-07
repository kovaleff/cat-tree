@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Categories <strong>({{ session('lang','en')}})</strong>
                    @if ($current !== '')
                        for {{ $current->title }}
                        <p><a href="/">Home</a></p>
                    @endif                    
                </div>

                <div class="panel-body">
                    {{ CategoryTree::showTree() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
