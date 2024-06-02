<!DOCTYPE html>
<html lang="en">
<head>
    @include('common.header')
</head>
<!-- Start Modules -->




<!-- Start Create Post Module -->
{{-- <div class="modal fade" id="create-post-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create A New Post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Title</label>
                <input type="text" name="title" class="form-control" id="post-title-input">
            </div>
            <div class="mb-3">
                <textarea id="post-body-input" name="body" style="width: 100%; height: 100px; border-color: gray; border-radius: 10px;">
                    
                </textarea>
            </div>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Image</label>
                <input type="file" name="image" class="form-control" id="post-image-input">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
        </div>
    </div>
    </div>
</div> --}}

<div class="modal fade" id="create-post-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create A New Post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="post-form" action="{{ route('posts.update', ['post' => 'POST_ID_PLACEHOLDER']) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="post-title-input">
                    </div>
                    <div class="mb-3">
                        <textarea id="post-body-input" name="body" style="width: 100%; height: 100px; border-color: gray; border-radius: 10px;"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="post-image-input">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" form="post-form">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- End Create Post Module -->


<!-- End Modules -->

{{-- <!-- Start Alert -->
@if (session()->has('success'))
<div class="alert alert-success fade show" style="position: fixed; z-index: 9999; width: 30%; bottom: 0; right: 0;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session()->get('success') }}
</div>
@elseif (session()->has('danger'))
<div class="alert alert-danger fade show" style="position: fixed; z-index: 9999; width: 30%; bottom: 0; right: 0;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> 
    {{ session()->get('danger') }}
</div>
@endif --}}

<!-- End Alert -->
@auth
<!--  Start Post Button -->
<div class="bg-primary" id="add-btn" data-bs-toggle="modal" data-bs-target="#create-post-modal">
+
</div>
<!-- End Post Button -->
@endauth

<!-- Start Navigation Bar-->
@include('common.navigation')
<!-- End Navigation Bar-->

<!-- Start Main Content -->
<div class="container" style="height: 1000px;">
    <div class="d-flex justify-content-center mt-5">
        <div class="col-9">
        <!-- Start Posts -->
        <div id="posts">
            @foreach ($posts as $post)
            <!-- Start Post -->
            <div class="card shadow">
                <div class="card-header">
                    <img class="rounded-circle border border-2" src="{{ Storage::url($post->user->profile_image) }}" alt="" style="width: 40px; height: 40px;">
                    <b>{{ $post->user->username }}</b>
                @auth
                @if (auth()->user()->id === $post->user->id)
                    <button type="button" class="btn btn-secondary float-end" data-bs-toggle="modal" data-bs-target="#create-post-modal" data-action="edit" data-post="{{ json_encode($post) }}">
                        Edit Post
                    </button>
                    <form action="{{ route('posts.delete', $post->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger float-end mx-2">
                            Delete Post
                        </button>
                    </form>
                @endif
                @endauth
                </div>
                <div class="card-body" style="cursor: pointer;" onclick="location.href='{{ route('posts.show', $post->id) }}'">
                <img class="w-100" src="{{ Storage::url($post->image) }}" alt="">

                <h6 style="color: rgb(193, 193, 193);" class="mt-1">
                    {{ $post->created_at->diffForHumans() }}
                </h6>
                <h5>
                    {{ $post->title }}
                </h5>
                <p>{{ $post->body }}</p>
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
        </div>

        @endforeach
        <!-- End Post -->
    </div>
</div>
<!-- End Posts -->

<!-- End Main Content -->
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var createPostModal = document.getElementById('create-post-modal');
        var postForm = document.getElementById('post-form');
        var modalTitle = document.getElementById('exampleModalLabel');
    
        createPostModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var action = button.getAttribute('data-action'); // Extract info from data-* attributes
            var postJson = button.getAttribute('data-post'); // Extract info from data-* attributes

            let post = JSON.parse(postJson);
            // Set the form's action URL and change the modal title based on the action
            // console.log(JSON.parse(post));
            if (action === 'edit') {
                postForm.action = postForm.action.replace('POST_ID_PLACEHOLDER', post.id);
                modalTitle.textContent = 'Edit Post';
                postForm.querySelector('button[type="submit"]').textContent = 'Edit';
                postForm.querySelector('input[name="title"]').value = post.title;
                postForm.querySelector('textarea[name="body"]').value = post.body;
                //Append @method('PUT') to the form
                var methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'PUT';
                postForm.appendChild(methodField);
            } else {
                postForm.action = '{{ route('posts.store') }}';
                modalTitle.textContent = 'Create A New Post';
                postForm.querySelector('button[type="submit"]').textContent = 'Create';
                postForm.querySelector('input[name="title"]').value = '';
                postForm.querySelector('textarea[name="body"]').value = '';
                // Remove @method('PUT') from the form if it exists
                var existingMethodField = postForm.querySelector('input[name="_method"]');
                if (existingMethodField) {
                    postForm.removeChild(existingMethodField);
                }
            }
        });
    });
</script>
</html>