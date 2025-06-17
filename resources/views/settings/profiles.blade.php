@extends('layouts.app')

@section('title', 'Settings - Profiles')

@section('breadcrumb')
    <li class="breadcrumb-item">Settings</li>
    <li class="breadcrumb-item active" aria-current="page">Profiles</li>
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
                            New Profile
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
                            id="profilesTable" 
                            class="table table-striped mt-2 mb-2"
                        >
                            <thead>
                                <tr id="profilesTableHead" />
                            </thead>
                            <tbody id="profilesTableBody" />
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
                            <label for="profile" class="form-label">Profile</label>
                            <input type="text" name="profile" id="profileName" class="form-control" placeholder="Profile name..." required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="profileDescription" class="form-control" rows="4" placeholder="Description..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="updateProfileBtn" type="button" class="btn btn-primary d-none">Update</button>
                    <button id="createProfileBtn" type="button" class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/settings/profiles.js') }}"></script>
@endsection