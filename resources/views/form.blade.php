@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <main class="form-adding-link">
              <form action="/" method="POST">
                <h1 class="h3 mb-3 fw-normal">Link Form</h1>
                @csrf

                <div class="form-floating">
                  <input type="text" name="url" class="form-control" id="floatingInput" placeholder="google.com">
                  <label for="floatingInput">Url</label>
                </div>

                <div class="form-floating">
                  <input type="number" name="clicks_limit" class="form-control" id="floatingInput" placeholder="google.com">
                  <label for="floatingInput">Clicks Limit</label>
                </div>

                <div class="form-floating">
                  <input type="number" name="expired_at" class="form-control" id="floatingPassword" placeholder="24" min="1" max="24">
                  <label for="floatingPassword">Expired At</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary" type="submit">Add</button>
              </form>
            </main>
        </div>

        <div class="col-md-6">
            <ul class="list-group mt-5">
                @foreach ($links as $link)
                <li class="list-group-item">
                    <a href="{{$link->token}}">{{ url('/') }}/{{$link->token}}</a>
                    <span class="badge">Click limit: {{ $link->clicks_limit }}</span>
                    <p>Expired at: {{ $link->expired_at }}</p>
                </li>
                @endforeach
            </ul>
        </div>

    </div>
</div>

@endsection
