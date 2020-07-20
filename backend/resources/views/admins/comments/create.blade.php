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
                    <form action="{{ route('admin.comment.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">News</label>
                            <select class="form-control" name="news_id" id="">
                                <option value="">Choose News</option>
                                @foreach ($news as $item)
                                <option value="{{ $item->id}}">{{ $item->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" id="" class="form-control" placeholder="Name"
                                aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" id="" class="form-control" placeholder="Email"
                                aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="">Comment</label>
                            <textarea class="form-control" name="comment_text" id="" rows="3"
                                placeholder="Comment"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Save Data</button>
                        <a href="{{ route('admin.comment.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('breadcumb')
Create Comment
@endsection