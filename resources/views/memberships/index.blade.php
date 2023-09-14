@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @if(session()->has('message'))
            <p class="alert {{ session('alert-class') }}">{{ session('message') }}</p>
        @endif

        @foreach (membership_types() as $key => $type)
        
        <div class="col-md-4">

            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $type['name'] }}</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">${{ $type['price'] }}</h6>
                    @can(['user'])
                    
                        @if (getuserCurrentMembershipType() == $key)
                            <a href="javascript:;" class="card-link">Currently Using</a>
                        @else
                            <a href="{{ route('membership.type', $key) }}" class="card-link">Upgrade</a>                    
                        @endif

                    @endcan

                    @guest
                        <a href="{{ route('membership.type', $key) }}" class="card-link">Get Started</a>
                    @endguest
                </div>
            </div>
            
        </div>

        @endforeach
       
    </div>
</div>
@endsection
