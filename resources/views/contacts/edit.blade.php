@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <edit-contact :contact="{{ $contact }}"></edit-contact>
            </div>
        </div>
    </div>
@endsection