<!DOCTYPE html>
<html lang="en">
<head>
    @include('common.header')
</head>
<body>
    @include('common.navigation')

    <!-- Start Main Content -->
<div class="container" style="height: 1000px;">
    <div class="d-flex justify-content-center mt-5">
        <div class="col-9">
        <!-- Start Posts -->
            <div id="posts">
            <!-- Start Post -->
                <div class="card shadow">
                    <div class="card-header">
                        <img class="rounded-circle border border-2" src="{{ Storage::url($post->user->profile_image) }}" alt="" style="width: 40px; height: 40px;">
                            <b>{{ $post->user->username }}</b>
                    </div>
                    <div class="card-body">
                        <img class="w-100" src="{{ Storage::url($post->image) }}" alt="">

                        <h6 style="color: rgb(193, 193, 193);" class="mt-1">
                            {{ $post->created_at->diffForHumans() }}
                        </h6>
                        <h5>
                            {{ $post->title }}
                        </h5>
                        <p> {{ $post->body }} </p>
                        <hr>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                            </svg>
                            <span>
                                ({{ $post->comments->count() }}) Comments
                            </span>
                        </div>
                    </div>

                    <!-- Start Comments -->
                    @foreach ($comments as $comment)
                    <div id="comments">
                        <!-- Start Comment -->
                        <div class="p-3" style="background-color: rgb(235, 235, 235);">
                            <!-- Start Profile Image + Username -->
                            <div>
                                <img src="{{ Storage::url($comment->user->profile_image) }}" class="rounded-circle" style="width: 40px; height: 40px;" alt="">
                                <b>{{ $comment->user->username }}</b>
                            </div>
                            <!-- End Profile Image + Username -->

                            
                                <!-- Start Body Comment -->
                                <div>
                                    {{ $comment->content }}
                                </div>
                                <!-- End Body Comment -->
                        </div>
                    @endforeach
                    <!-- End Comment -->
                    @auth
                    <form action="{{ route('comments.store') }}" method="POST">
                        <div class="input-group">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <input id="comment-input" name="content" type="text" placeholder="Add Your Comment Here.." class="form-control">
                            <button class="btn btn-outline-primary" type="submit">send</button>
                        </div>
                    </form>
                    @endauth
                    <!-- End Comments -->
                </div>
                <!-- End Post -->
</body>
</html>