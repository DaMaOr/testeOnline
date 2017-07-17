@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: beige"><b>Editare test</b></div>
                    <div class="panel-body" style="background-color: beige">
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
                                @foreach($test->questions as $key => $question)
                                    <div class="question">
                                        <div class="form-group">
                                            <label for="questionName" class="col-md-4 control-label">Întrebare</label>
                                            <div class="question-name-wrapper col-md-8">
                                                <div class="col-md-5">
                                                    <input type="hidden" value="{{$question->id}}" name="questionName[{{$key}}][id]">
                                                    <input id="questionName" value="{{$question->body}}" type="text" class="form-control" name="questionName[{{$key}}][body]" required autofocus>
                                                    <div class="col-md-12">
                                                        @foreach($question->answers as $ind => $answer)
                                                            <div class="answer-wrap">
                                                                <input type="hidden" value="{{$question->id}}" name="questionName[{{$key}}][answers][{{$ind}}][id]">
                                                                <label for="questionAnswer" class="col-md-2 control-label">#{{$ind + 1}}</label><input value="{{$answer->body}}" id="questionAnswer" class="form-control" type="text" name="questionName[{{$key}}][answers][{{$ind}}][body]">
                                                                <div class="checkbox">
                                                                    <label><input type="checkbox" value="true" name="questionName[{{$key}}][answers][{{$ind}}][correct]" @if($answer->correct) checked @endif>Corect</label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <button class="btn btn-danger delete-question" onclick="removeQuestion(event)">X</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
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
    <script>
        <?php
            $questionIds = $test->questions()->select('id')->get()->pluck('id')->toArray();
            ?>
        var questionCounter  = {{(count($questionIds) >= 1 ? max($questionIds):0) + 1}};
    </script>
    <script src="{{asset('js/test.js')}}"></script>
@stop
