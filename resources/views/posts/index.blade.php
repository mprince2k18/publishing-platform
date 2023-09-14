@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="text-end my-3">
                <a href="{{ route('post.create') }}" class="btn btn-secondary">{{ __('Add New Post') }}</a>
            </div>

            <div class="card">
                <div class="card-header">{{ __('Posts') }}</div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('Title') }}</th>
                            <th scope="col">{{ __('Status') }}</th>
                            <th scope="col">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse (getPosts() as $post)

                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->status }}</td>
                                <td>
                                    <a href="javascript:;" class="btn btn-light" disabled>{{ __('View') }}</a>
                                </td>
                            </tr>
                                
                            @empty

                            <tr>
                                <td colspan="4" class="text-center">
                                    {{ __('No Data Found') }}
                                </td>
                            </tr>
                                
                            @endforelse
                        </tbody>
                    </table>

                    {{ getPosts()->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
