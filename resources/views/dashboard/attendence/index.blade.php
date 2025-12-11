@extends('dashboard.includes.master')
@section('title', 'HR System')

@section('css')
<style>
  #searchInput {
    max-width: 350px;
    margin: 2rem 2rem 1rem auto !important;
    box-shadow: 0 1px 1px #eee7ee99, 0 -1px 1px #eee7ee99;
}
    .head-email {
        color: #035076;
        font-weight: 600;
    }
    .sort-icon {
        cursor: pointer;
        margin-left: 5px;
    }
    .sort-asc::after {
        content: '↑';
    }
    .sort-desc::after {
        content: '↓';
    }
    .sort-none::after {
        content: '↕';
    }
    th.sortable {
        cursor: pointer;
        user-select: none;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    .table th, .table td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    .table th {
        background-color: #f2f2f2;
    }
    .pagination {
        margin-top: 10px;
    }
    .pagination .page-link {
        margin: 0 5px;
    }
</style>
@endsection

@section('content')
<div class="col-xl-12">
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex">
                        <a href="#" class="btn btn-primary btn-sm me-2">
                            <i class="ri-add-line"></i> Add Category
                        </a>
                    </div>
                </div>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div>
                    <input type="text" id="searchInput" class="form-control" placeholder="Search by name, description, or email count...">
                </div>

                <div class="card-body">
                    <table id="file-export" class="table table-bordered text-nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="sortable" data-sort="name">Name <span class="sort-icon sort-none"></span></th>
                                <th class="sortable" data-sort="desc">Description <span class="sort-icon sort-none"></span></th>
                                <th>Operations</th>
                                <th class="sortable" data-sort="email_count">Count Emails <span class="sort-icon sort-none"></span></th>
                            </tr>
                        </thead>
                        <tbody id="categoryTableBody">
                         
                        </tbody>
                    </table>
               
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this category?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection
