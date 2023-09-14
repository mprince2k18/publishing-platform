@extends('layouts.app')
@push('css')
    <style>
        .ck-editor__editable {
            min-height: 300px;
        }
    </style>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="text-end my-3">
                
            </div>

            <div class="card">
                <div class="card-header">{{ __('Add New Post') }}</div>

                <div class="card-body">

                    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">{{ __('Post Title') }}</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="{{ __('Post Title') }}">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="editor" class="form-label">{{ __('Descripiton') }}</label>
                            <textarea name="body" id="editor" class="form-control @error('body') is-invalid @enderror"></textarea>
                            @error('body')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <button type="submit" value="1" name="publish_now" class="btn btn-success">{{ __('Publish Now') }}</button>
                        @can('premium')
                        <a href="javascrip:;"  class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">{{ __('Publish Later') }}</a>
                        @endcan
                        <button type="submit" value="3" name="draft" class="btn btn-dark">{{ __('Draft') }}</button>

                        @can('premium')
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('Schedule Post') }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input class="form-control" type="datetime-local" name="published_at" id="datetime" />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                                    <button type="submit" value="2" name="publish_later" class="btn btn-primary">{{ __('Save Schedule') }}</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        @endcan

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ))
            .then( editor => {
                editor.ui.view.editable.element.style.height = '300px';
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endpush
