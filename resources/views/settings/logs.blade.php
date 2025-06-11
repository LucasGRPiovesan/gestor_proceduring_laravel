@extends('layouts.app')

@section('title', 'Logs - Atividades de Usuários')

@section('breadcrumb')
    <li class="breadcrumb-item">Settings</li>
    <li class="breadcrumb-item active" aria-current="page">Logs</li>
@endsection

@php
    $names = ['Lucas Lima', 'Mariana Souza', 'Carlos Silva', 'Ana Paula', 'João Pedro'];
    $profiles = ['Admin', 'Operator', 'Manager', 'Support'];
    $actions = ['created a user', 'deleted a user', 'updated a profile', 'logged in', 'logged out'];
    $logs = [];

    foreach (range(1, 10) as $i) {
        $name = $names[array_rand($names)];
        $profile = $profiles[array_rand($profiles)];
        $action = $actions[array_rand($actions)];
        $email = strtolower(str_replace(' ', '.', $name)) . '@example.com';

        $logs[] = [
            'user' => $name,
            'action' => $action,
            'message' => "$name ($profile) $action ($email)",
            'timestamp' => now()->subMinutes(rand(1, 120))->format('Y-m-d H:i:s'),
        ];
    }
@endphp

@section('content')
    <div class="page-content container">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Activity Logs</h5>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Action</th>
                                    <th>Log</th>
                                    <th>Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $log)
                                    <tr>
                                        <td>{{ $log['user'] }}</td>
                                        <td>{{ $log['action'] }}</td>    
                                        <td>{{ $log['message'] }}</td>
                                        <td>{{ $log['timestamp'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row d-flex justify-content-end mt-2">
                    <div class="col-6 d-flex justify-content-end">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
