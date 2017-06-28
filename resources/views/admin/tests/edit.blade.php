@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: beige"><b>Editare test</b></div>
                    <div class="panel-body" style="background-color: yellow">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('testsUpdate', $test->id) }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nume</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $test->name }}" required autofocus>

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
                                    <input id="access_key" type="text" class="form-control" name="access_key" value="{{ $test->access_key }}" required autofocus>

                                    @if ($errors->has('access_key'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('access_key') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status" class="col-md-4 control-label">Status</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="status" name="status">
                                        @foreach($statuses as $status)
                                            <option value="{{ $status->id }}"
                                                    @if($test->status_id == $status->id) selected @endif
                                            >{{ $status->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status" class="col-md-4 control-label">Curs</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="status" name="category">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                    @if($test->category_id == $category->id) selected @endif
                                            >{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" id="addQuestion" class="btn btn-primary">
                                        Adăugare întrebare
                                    </button>
                                </div>
                            </div>

                            <div id="questions">
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Salvare
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

@section('scripts')
    <script src="{{asset('js/test.js')}}"></script>
@stop
