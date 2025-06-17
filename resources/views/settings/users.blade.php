@extends('layouts.app')

@section('title', 'Cadastro - Formulários')

@section('breadcrumb')
    <li class="breadcrumb-item">Settings</li>
    <li class="breadcrumb-item active" aria-current="page">Users</li>
@endsection

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
                        <table class="table" id="usersTable">
                            <thead>
                                <tr id="usersTableHead" />
                            </thead>
                            <tbody id="usersTableBody" />
                        </table>
                    </div>
                </div>
                {{-- <div class="row d-flex justify-content-end mt-2">
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
                </div> --}}
            </div>
        </div>
    </div>

    <script src="{{ asset('js/settings/users.js') }}"></script>
@endsection