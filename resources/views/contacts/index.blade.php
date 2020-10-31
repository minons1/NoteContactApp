@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">My contacts</div>
                    <div class="panel-body">
                        @if($contacts->isEmpty())
                            <p>
                                You have not created any contacts! <a href="{{ url('contact/create') }}">Create one</a> now.
                            </p>
                        @else
                        <ul class="list-group">
                            @foreach($contacts as $contact)
                                <li class="list-group-item">
                                    <a href="{{ url('contact/edit', [$contact->slug]) }}">
                                        {{ $contact->name }}
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="{{ url('contact/delete', [$contact->slug]) }}">Delete</a>

                                    <span class="pull-right">{{ $contact->updated_at->diffForHumans() }}</span>
                                </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection