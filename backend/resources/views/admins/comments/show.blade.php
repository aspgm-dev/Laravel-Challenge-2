@extends('admins.layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <label for="">Created At :</label>
                        <p>{{ date_idn($comment->created_at) }}</p>

                        <label for="">News :</label>
                        <p>{{ $comment->news->title }}</p>

                        <label for="">Name :</label>
                        <p>{{ $comment->name }}</p>

                        <label for="">Email :</label>
                        <p>{{ $comment->email }}</p>
                        
                        <label for="">Comment Text :</label>
                        <p>{{ $comment->comment_text }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('breadcumb')
    Detail Comment
@endsection