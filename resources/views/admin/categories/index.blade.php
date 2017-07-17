@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="overflow:hidden; background-color: beige"><b>Cursuri</b>
                        <a href="{{  route('categoriesAdd') }}" class="btn btn-primary pull-right">Adăugare</a>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Nume</th>
                                <th>Status</th>
                                <th>Actiuni</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name  }}</td>
                                    <td>{{ $category->status->name  }}</td>
                                    <td>
                                        <a href="{{ route('categoriesEdit', $category->id) }}" class="btn btn-success">Editare</a>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteCategoryModal-{{$category->id}}">Ștergere</button>
                                        <div id="deleteCategoryModal-{{$category->id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Ștergere curs - <b>{{$category -> name}}</b></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Sigur doriți să ștergeți acest curs?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a type="button" class="btn btn-danger" href="{{ route('categoriesDelete', $category->id) }}">Da</a>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Nu</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
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

@endsection
