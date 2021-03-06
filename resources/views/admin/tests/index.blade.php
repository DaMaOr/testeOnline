@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="overflow:hidden;background-color: beige"><b>Teste</b>
                        @if(Auth()->user()->roles !== \App\User::STUDENT )
                            <a href="{{  route('testsAdd') }}" class="btn btn-primary pull-right">Adauga</a>
                        @endif
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Nume</th>
                                <th>Curs</th>
                                <th>Profesor</th>
                                <th>Status</th>
                                <th>Nota</th>
                                <th>Actiuni</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tests as $test)
                                <tr>
                                    <td>{{ $test->name  }}</td>
                                    <td>{{ $test->category->name  }}</td>
                                    <td>{{ $test->user->name  }}</td>
                                    <td>{{ $test->status->name  }}</td>
                                    <td>{{Auth::user()->tests()->where('id', $test->id)->first() ? Auth::user()->tests()->where('id', $test->id)->first()->pivot->grade : 'Nerezolvat'}}</td>
                                    <td>
                                        @if(Auth()->user()->roles !== \App\User::STUDENT )
                                            <a href="{{ route('testsEdit', $test->id) }}" class="btn btn-success">Editare</a>
                                            <button class="btn btn-danger" data-toggle="modal"
                                                    data-target="#deleteTestModal-{{$test->id}}">Sterge
                                            </button>
                                            <!-- Modal -->
                                            <div id="deleteTestModal-{{$test->id}}" class="modal fade" role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                &times;
                                                            </button>
                                                            <h4 class="modal-title">Ștergere test</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Sigur doriți să ștergeti acest test?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a type="button" class="btn btn-danger"
                                                               href="{{ route('testsDelete', $test->id) }}">Da</a>
                                                            <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Nu
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        @elseif($test->status->id == 1 && !Auth::user()->tests->contains($test->id))
                                            <a href="{{Route('testAccess', $test->id)}}" class="btn btn-danger">Începe test</a>
                                        @elseif($test->status->id == 1 && Auth::user()->tests->contains($test->id))
                                            <a href="{{Route('taken', $test->id)}}" class="btn btn-success">Vezi rezolvarea</a>
                                        @elseif($test->status->id == 2 && Auth::user()->tests->contains($test->id))
                                            <a href="{{Route('taken', $test->id)}}" class="btn btn-success">Vezi rezolvarea</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
