@extends('layouts.public.layout')

@section('title', 'Login')

@section('content')
  <div class="hero min-h-screen bg-base-200">
    <div class="hero-content flex-col lg:flex-row-reverse">
      <div class="card shrink-0 w-full max-w-sm shadow-2xl bg-base-200">
        <form method="POST" action="{{ route('login.attempt') }}" class="card-body">
          @csrf

          <div class="form-control">
            <label class="label">
              <span class="label-text">Email</span>
            </label>
            <input type="email" name="email" placeholder="email" class="input input-bordered" />
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Password</span>
            </label>
            <input type="password" name="password" placeholder="password" class="input input-bordered" />
          </div>
          <div class="form-control mt-6">
            <button class="btn btn-primary">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  @include('layouts.public.footer')
@endsection

@section('js-footer')
  {!! JsValidator::formRequest('App\Http\Requests\LoginRequest', 'form') !!}
@endsection
