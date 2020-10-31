@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                    <div class="panel-heading">Create new contacts</div>
                    <div class="panel-body">
                        <form action="{{ url('contact/edit/'.$contact->slug) }}" method="POST" class="form" role="form">
                            {{ csrf_field() }}
                            {!! method_field('put') !!}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="name" value="{{ $contact->name }}" placeholder="Give your contact a name" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="number" value="{{ $contact->number }}" placeholder="...and here goes your contact number" required autofocus>

                                @if ($errors->has('number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('number') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button class="btn btn-primary pull-right">Save</button>
                        </form>
                    </div>
                </div>
                <!-- <edit-contact :contact="{{ $contact }}"></edit-contact> -->
            </div>
        </div>
    </div>
@endsection