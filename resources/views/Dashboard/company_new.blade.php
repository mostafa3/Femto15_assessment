@extends('layouts.dashboard')

@section('content')
@include('inc.sidebar')





      <div class='container'>
        <div class="">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('companies')}}">Company</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create New Company</li>
          </ol>
        </nav>
      </div>
{!!Form::open(['action' => 'AdminController@create_company', 'method' => 'post'])!!}
          <div class="form-group row">
              <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>

              <div class="col-sm-7">
                  <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                  @if ($errors->has('name'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <div class="form-group row">
              <label for="email" class="col-lg-2 col-form-label">{{ __('E-Mail Address') }}</label>

              <div class="col-sm-7">
                  <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                  @if ($errors->has('email'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <div class="form-group row">
              <label for="phone" class="col-sm-2 col-form-label">Phone</label>

              <div class="col-sm-7">
                  <input id="phone" type="number" class="form-control{{ $errors->has('tel') ? ' is-invalid' : '' }}" name="tel" value="{{ old('tel') }}" required>

                  @if ($errors->has('tel'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('tel') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <div class="form-group row">
              <label for="address" class="col-sm-2 col-form-label">Address</label>
              <div class="col-sm-7">
                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required>
                  @if ($errors->has('address'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('address') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                      {{ __('Register') }}
                  </button>
              </div>
          </div>

{!! Form::close() !!}
        </div> <!-- Container -->
@endsection
