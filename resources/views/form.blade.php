@extends('layouts.app')

@section('content')
<main class="form-signin">
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

    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
  </form>
</main>
@foreach ($links as $link)
    <a href="{{$link->token}}">{{$link->token}}</a>
    <p>Click limit: {{ $link->clicks_limit }}</p>
    <p>Expired at: {{ $link->expired_at }}</p>
@endforeach
@endsection
