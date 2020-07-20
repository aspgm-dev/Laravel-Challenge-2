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
                    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Upload Photo</label>
                            <input type="file" class="form-control-file" name="image_name">
                        </div>
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" id="" class="form-control" placeholder="Title" value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                            <label for="">Content</label>
                            <textarea class="form-control" name="content" id="" rows="8"
                                placeholder="Content">{{ old('content') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Category</label>
                            <select class="form-control" name="category_id" id="">
                                <option value="">Choose Category</option>
                                @foreach ($categories as $item)
                                <option value="{{ $item->id }}" {{ old('category_id') ? 'selected' : '' }}>{{ $item->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tag</label>
                            <select multiple class="form-control" name="tag_id[]" id="">
                                @foreach ($tags as $item)
                                <option value="{{ $item->id }}" {{ old('tag_id') == $item->id ? 'selected' : ''}}>{{ $item->tag_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-success" type="submit">Save Data</button>
                        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('breadcumb')
Create News
@endsection