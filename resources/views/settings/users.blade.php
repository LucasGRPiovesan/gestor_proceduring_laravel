@extends('layouts.app')

@section('title', 'Cadastro - Formulários')

@section('breadcrumb')
    <li class="breadcrumb-item">Settings</li>
    <li class="breadcrumb-item active" aria-current="page">Users</li>
@endsection

@php
    $users = [
        ['name' => 'Lucas Lima', 'profile' => 'Admin', 'status' => 'Enabled', 'email' => 'lucas.lima@example.com'],
        ['name' => 'Mariana Souza', 'profile' => 'Operator', 'status' => 'Disabled', 'email' => 'mariana.souza@example.com'],
        ['name' => 'Carlos Silva', 'profile' => 'Operator', 'status' => 'Enabled', 'email' => 'carlos.silva@example.com'],
        ['name' => 'Ana Paula', 'profile' => 'Admin', 'status' => 'Enabled', 'email' => 'ana.paula@example.com'],
        ['name' => 'João Pedro', 'profile' => 'Operator', 'status' => 'Disabled', 'email' => 'joao.pedro@example.com'],
    ];
@endphp

@section('content')
    <div class="page-content container">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-end">
                    <div class="col-2 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary">New User</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Profile</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user['name'] }}</td>
                                        <td>
                                            <span class="badge text-bg-primary">{{ $user['profile'] }}</span>
                                        </td>
                                        <td>
                                            <span class="badge text-bg-{{ $user['status'] === 'Enabled' ? 'primary' : 'danger' }}">
                                                {{ $user['status'] }}
                                            </span>
                                        </td>
                                        <td>{{ $user['email'] }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                </svg>
                                            </button>
                                            <button type="button" class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                                </svg>
                                            </button>
                                        </td>
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