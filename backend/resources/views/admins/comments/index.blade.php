@extends('admins.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('admin.comment.create') }}" class="btn btn-primary mb-2">Create Comment</a>
                        </div>
                        <div class="row mr-2">

                            <form action="{{ route('admin.comment.index') }}" method="get" class="row mr-1"
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
                        <table class="table table-sm table-hover table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>News</th>
                                    <th>Created At</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($comments as $no => $item)
                                <tr class="text-center">
                                    <td>
                                        {{ ($currentPage - 1) * $perPage + $no + 1 }}
                                    </td>
                                    <td>
                                        {{ $item->name }}
                                    </td>
                                    <td>
                                        {{ $item->email }}
                                    </td>
                                    <td>
                                        {{ $item->news->title }}
                                    </td>
                                    <td>
                                        {{ date_idn($item->created_at) }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.comment.show', $item->id) }}"
                                            class="btn btn-sm btn-info">Show</a>
                                        <a href="{{ route('admin.comment.edit', $item->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#deleteComment">
                                            Delete
                                        </button>

                                        @include('admins.comments.modal')
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Data not found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination pagination-sm">
                        {{ $comments->appends(Request::all())->links() }}
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('breadcumb')
Comment
@endsection