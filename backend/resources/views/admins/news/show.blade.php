@extends('admins.layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <img src="{{ asset('storage/'. $news->image_name) }}" class="d-block w-100" height="450px">
                    {{ asset('storage/'. $news->image_name) }}
                    <h4 class="text-capitalize text-justify mt-5 font-weight-bold">{{ $news->title }}</h4>
                    <label class="text-muted">{{ date_idn2($news->created_at) }}</label>

                    <p class="text-justify">
                        {{ $news->content }}
                    </p>
                    <label for="">Category </label>
                    : {{ $news->category->category_name }}
                    <br>
                    <label for="">Tag</label> :
                    @if (!$news->tags)
                    @else
                    @foreach ($news->tags()->get() as $item)
                    <span class="badge badge-secondary">
                        {{ $item->tag_name }}
                    </span>
                    @endforeach
                    @endif

                    <hr>
                    <div class="card direct-chat direct-chat-primary">
                        <div class="card-header">
                            <h3 class="card-title">Comment ({{ $news->comments->count() }})</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                        class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages">
                                <!-- Message. Default to the left -->
                                @foreach ($news->comments as $item)
                                <div
                                    class="direct-chat-msg {{ $item->email == \Auth::user()->email ? 'right' : '' }}">
                                    <div class="direct-chat-infos clearfix">
                                        <span
                                            class="direct-chat-name float-{{ $item->email == \Auth::user()->email ? 'right' : 'left' }} text-capitalize">{{ $item->name }}</span>
                                        <span
                                            class="direct-chat-timestamp float-{{ $item->email == \Auth::user()->email ? 'left' : 'right' }}">{{ Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</span>
                                    </div>
                                    <!-- /.direct-chat-infos -->
                                    <img class="direct-chat-img"
                                        src="{{ asset('admin-lte/dist/img/user1-128x128.jpg') }}"
                                        alt="message user image">
                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text">
                                        {{ $item->comment_text }}
                                    </div>
                                    <!-- /.direct-chat-text -->
                                </div>
                                @endforeach
                                <!-- /.direct-chat-msg -->
                            </div>
                            <div class="direct-chat-contacts">
                                <ul class="contacts-list">
                                    <li>
                                        <a href="#">
                                            <img class="contacts-list-img"
                                                src="{{ asset('admin-lte/dist/img/user1-128x128.jpg') }}">

                                            <div class="contacts-list-info">
                                                <span class="contacts-list-name">
                                                    Count Dracula
                                                    <small class="contacts-list-date float-right">2/28/2015</small>
                                                </span>
                                                <span class="contacts-list-msg">How have you been? I was...</span>
                                            </div>
                                            <!-- /.contacts-list-info -->
                                        </a>
                                    </li>
                                </ul>
                                <!-- /.contacts-list -->
                            </div>
                            <!-- /.direct-chat-pane -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <form action="{{ route('admin.add-comment') }}" method="post">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="comment_text" placeholder="Type Message ..."
                                        class="form-control">
                                    <span class="input-group-append">
                                        <button type="submit" value="{{ $news->id }}" name="news_id"
                                            class="btn btn-primary">Send</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('breadcumb')
Detail News
@endsection