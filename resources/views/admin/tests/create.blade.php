@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: beige"><b>Adăugare test</b></div>
                    <div class="panel-body" style="background-color: yellow">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('testsStore') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nume</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('access_key') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Cheie de acces</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="access_key" value="{{ old('access_key') }}" required autofocus>

                                    @if ($errors->has('access_key'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('access_key') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Status</label>

                                <div class="col-md-6">

                                    <select class="form-control" name="status" id="statusSelect">
                                        @foreach($statuses as $status)
                                            <option value="{{$status->id}}">{{$status->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('categories') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Curs</label>

                                <div class="col-md-6">

                                    <select class="form-control" name="category" id="categorySelect">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('categories'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('categories') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Adăugare
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
