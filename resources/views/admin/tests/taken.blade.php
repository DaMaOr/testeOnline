@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: beige">
                        <b>{{ $test->name  }}</b>
                        <span class="pull-right"><b>Nota: </b>{{Auth::user()->tests()->where('id', $test->id)->first()->pivot->grade}} </span>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('testsTaken', $test->id) }}">
                            {{ csrf_field() }}

                            @foreach($test->questions as $ind => $question)
                                <div class="question">
                                    <div class="question-body">
                                        <p><b>{{$ind + 1}}.</b> {{$question->body}}<br> <b>({{$question->answers()->correct(true)->count()}} raspunsuri corecte)</b></p>
                                    </div>
                                    <div class="question-answers">
                                        @foreach($question->answers as $indAns => $answer)
                                            <div class="checkbox">
                                                <?php $userTest = Auth::user()->tests()->where('id', $test->id)->first();
                                                    $userSelections = json_decode($userTest->pivot->answered, true);
                                                ?>
                                                <label class="{{$answer->correct ? 'correct':'incorrect'}}"><input @if(!empty($userTest) && isset($userSelections[$question->id]) && in_array($answer->id, $userSelections[$question->id])) checked @endif type="checkbox" disabled value="{{$answer->id}}" name="answer[{{$question->id}}][]">{{$answer->body}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
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

