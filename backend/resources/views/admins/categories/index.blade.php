@extends('admins.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    @if(count($errors))
                    <div class="card">
                        <div class="card-body bg-danger">
                            @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-primary mb-2" data-toggle="modal"
                                data-target="#createCategory">
                                Create Category
                            </button>
                        </div>
                        <div class="row mr-2">

                            <form action="{{ route('admin.category.index') }}" method="get" class="row mr-1"
                                id="filterForm">
                                <div class="form-group mr-2">
                                    <input type="text" name="search" value="{{ Request::get('search') }}" id=""
                                        class="form-control" placeholder="Search">
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="sortby"
                                        onchange="document.getElementById('filterForm').submit()">
                                        <option value="">Sort By</option>
                                        <option value="newest"
                                            {{ Request::get('sortby') == 'newest' ? 'selected' : '' }}>Newest</option>
                                        <option value="latest"
                                            {{ Request::get('sortby') == 'latest' ? 'selected' : '' }}>Latest</option>
                                        <option value="a-z" {{ Request::get('sortby') == 'a-z' ? 'selected' : '' }}>A -
                                            Z</option>
                                        <option value="z-a" {{ Request::get('sortby') == 'z-a' ? 'selected' : '' }}>Z -
                                            A</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $no => $item)
                                <tr class="text-center">
                                    <td>
                                        {{ ($currentPage - 1) * $perPage + $no + 1 }}
                                    </td>
                                    <td>
                                        {{ $item->category_name }}
                                    </td>
                                    <td>
                                        {{ date_idn($item->created_at) }}
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-warning" data-toggle="modal"
                                            data-target="#editCategory">
                                            Edit
                                        </a>

                                        <a href="#" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#deleteCategory">
                                            Delete
                                        </a>

                                        @include('admins.categories.modal')
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Data not found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination pagination-sm">
                        {{ $categories->appends(Request::all())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="createCategory" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.category.store') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" class="form-control" type="text" name="category_name" placeholder="Name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('breadcumb')
Category
@endsection