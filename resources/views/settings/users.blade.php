@extends('layouts.app')

@section('title', 'Settings - Users')

@section('breadcrumb')
    <li class="breadcrumb-item">Settings</li>
    <li class="breadcrumb-item active" aria-current="page">Users</li>
@endsection

@section('content')
    <div class="page-content container">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-between">
                    <div class="col-4 d-flex justify-content-start align-items-baseline gap-2">
                        <small>Show</small>
                        <div class="col-2">
                            <select
                                id="perPage" 
                                class="form-select" 
                                aria-label="Default select example"
                            >
                                <option value="5" selected>5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                            </select>
                        </div>
                        <small>by page.</small>
                    </div>                    
                    <div class="col-2 d-flex justify-content-end">
                        <button
                            id="openModalBtn" 
                            type="button" 
                            class="btn btn-primary"
                        >
                            New User
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex flex-column align-items-center">
                        <div
                            id="loader" 
                            class="spinner-border mt-2 mb-2 d-none" 
                            role="status"
                        >
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <table
                            id="usersTable" 
                            class="table table-striped mt-2 mb-2"
                        >
                            <thead>
                                <tr id="usersTableHead" />
                            </thead>
                            <tbody id="usersTableBody" />
                        </table>
                    </div>
                </div>
                <div class="row d-flex justify-content-end mt-2">
                    <div class="col-6 d-flex justify-content-end">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination" id="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" data-action="prev" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>
                                <li class="page-item"><a class="page-link" href="#" data-page="2">2</a></li>
                                <li class="page-item"><a class="page-link" href="#" data-page="3">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" data-action="next" aria-label="Next">
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

    <div 
        id="exampleModal" 
        class="modal fade" 
        tabindex="-1"
        data-bs-backdrop="static" 
        aria-labelledby="exampleModalLabel" 
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="userName" class="form-control" placeholder="Name..." required>
                        </div>

                        <div class="mb-3">
                            <label for="profile" class="form-label">Profile</label>
                            <select
                                id="profile" 
                                class="form-select" 
                                aria-label="Default select example"
                                placeholder="Select a profile..."
                            >
                                <option value="" selected></option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="text" name="email" id="userEmail" class="form-control" placeholder="E-mail..." required>
                        </div>

                        <div class="mb-3 only-create">
                            <label for="password" class="form-label">Senha provisória</label>
                            <input type="text" name="password" id="userPassword" class="form-control" placeholder="Enter a temporary password..." required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="updateUserBtn" type="button" class="btn btn-primary d-none">Update</button>
                    <button id="createUserBtn" type="button" class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/settings/users.js') }}"></script>
@endsection