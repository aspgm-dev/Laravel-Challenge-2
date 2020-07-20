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
                    <form action="{{ route('admin.news.update', $news->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Upload Photo</label>
                            <input type="file" class="form-control-file" name="image_name">
                        </div>
                        <div class="row">
                            <img src="{{ asset('storage/'. $news->image_name) }}" class="d-block w-25" height="150px">
                        </div>

                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" id="" class="form-control" placeholder="Title"
                                value="{{ $news->title }}">
                        </div>
                        <div class="form-group">
                            <label for="">Content</label>
                            <textarea class="form-control" name="content" id="" rows="8"
                                placeholder="Content">{{ $news->content }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Category</label>
                            <select class="form-control" name="category_id" id="">
                                <option value="">Choose Category</option>
                                @foreach ($categories as $item)
                                <option value="{{ $item->id }}" {{ $news->category_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Tag</label>
                            <select multiple class="form-control" name="tag_id[]" id="">
                                @foreach ($tags as $item)
                                <option value="{{ $item->id }}" @foreach ($news->tags()->get() as $item_tags)
                                    {{ $item_tags->id == $item->id ? 'selected' : ''}} @endforeach>
                                    {{ $item->tag_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-success" type="submit">Update</button>
                        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('breadcumb')
Edit News
@endsection
