@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Your todo') }}</div>

                <div class="card-body text-center">
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a><br>
                    <b>Your todo title is : </b> {{ $todo->title }} <br>
                    <b>Your todo description is :</b> {{ $todo->description }} <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
