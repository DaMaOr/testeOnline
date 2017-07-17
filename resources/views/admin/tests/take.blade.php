@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: beige">
                        <b>{{ $test->name  }}</b></div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('testsTaken', $test->id) }}">
                            {{ csrf_field() }}

                            @foreach($test->questions as $ind => $question)
                                <div class="question">
                                    <div class="question-body">
                                        <p><b>{{$ind + 1}}.</b> {{$question->body}}<br> <b>(Răspunsuri corecte: {{$question->answers()->correct(true)->count()}})</b></p>
                                    </div>
                                    <div class="question-answers">
                                        @foreach($question->answers as $indAns => $answer)
                                            <div class="checkbox">
                                                <label><input type="checkbox" value="{{$answer->id}}" name="answer[{{$question->id}}][]">{{$answer->body}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Trimite
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

