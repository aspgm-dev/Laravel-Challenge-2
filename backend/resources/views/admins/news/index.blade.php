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
                            <a href="{{ route('admin.news.create') }}" class="btn btn-primary mb-2">
                                Create News
                            </a>
                        </div>
                        <div class="row mr-2">
                            <form action="{{ route('admin.news.index') }}" method="get" class="row mr-1"
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
                                    <th>Title</th>
                                    <th>Created At</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($news as $no => $item)
                                <tr class="text-center">
                                    <td>
                                        {{ ($currentPage - 1) * $perPage + $no + 1 }}
                                    </td>
                                    <td>
                                        {{ $item->title }}
                                    </td>
                                    <td>
                                        {{ date_idn($item->created_at) }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.news.show', $item->id) }}"
                                            class="btn btn-sm btn-info">Show</a>
                                        <a href="{{ route('admin.news.edit', $item->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#deleteNews">
                                            Delete
                                        </button>

                                        @include('admins.news.modal')
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
                        {{ $news->appends(Request::all())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('breadcumb')
News
@endsection