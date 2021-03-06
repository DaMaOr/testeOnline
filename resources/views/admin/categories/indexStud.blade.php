@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="overflow:hidden;background-color: beige"><b>Cursuri</b>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Nume</th>
                                <th>Profesor</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name  }}</td>
                                    @foreach($users as $user)
                                        @if($category->user_id == $user->id)
                                    <td>{{ $user->name}}</td>
                                        @endif
                                    @endforeach
                                    <td>{{ $category->status->name  }}</td>
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
