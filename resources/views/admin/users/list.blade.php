@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="overflow:hidden;background-color: beige"><b>Listă conturi</b>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Nume</th>
                                <th>Rol</th>
                                <th>Acțiuni</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name  }}</td>
                                    <td>{{ $user->roles }}</td>
                                    <td>
                                        @if(!$user->verified)
                                            <a href="{{ Route('usersChangeStat', ['user' => $user, 'status' => 1]) }}" class="btn btn-success">Activare cont</a>
                                        @else
                                            <a href="{{ Route('usersChangeStat', ['user' => $user, 'status' => 0]) }}" class="btn btn-danger">Dezactivare cont</a>
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


