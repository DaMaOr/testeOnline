@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: beige"><b>Cheie de access</b></div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{Route('testCheckKey', $test->id)}}">
                            {{ csrf_field() }}

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
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Începe test
                                    </button>
                                    <a href="{{Route('testsIndex')}}"  class="btn btn-primary">
                                        Înapoi
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
