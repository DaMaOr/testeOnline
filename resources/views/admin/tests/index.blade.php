@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="overflow:hidden;">Tests
                        <a href="{{  route('testsAdd') }}" class="btn btn-primary pull-right">Adauga</a>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nume</th>
                                <th>Utilizator</th>
                                <th>Categorie</th>
                                <th>Status</th>
                                <th>Actiuni</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tests as $test)
                                <tr>
                                    <td>
                                        <a href="{{ route('testsEdit', $test->id) }}" class="btn btn-success">Editare</a>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteTestModal">Sterge</button>
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

    <!-- Modal -->
    <div id="deleteTestModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sterge test</h4>
                </div>
                <div class="modal-body">
                    <p>Sigur doriti sa stergeti acest test ?</p>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-danger" href="{{ route('testsDelete', $test->id) }}">Da</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Nu</button>
                </div>
            </div>

        </div>
    </div>
@endsection
