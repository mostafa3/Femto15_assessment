@extends('layouts.dashboard')

@section('content')

@include('inc.sidebar')
@if(!$companies->first())
  @if(auth()->guard('admin')->check())
    <h3>you must create companies first</h3>
  @else
    <h3>there is no companies</h3>
  @endif
@else

      <div class='container'>
        <div class="">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('employees')}}">Employees</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create New Employee</li>
          </ol>
        </nav>
      </div>
{!!Form::open(['action' => 'AdminController@create_employee', 'method' => 'post'])!!}
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
                  <input id="phone" type="number" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>

                  @if ($errors->has('phone'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('phone') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <div class="form-group row">
              <label for="company" class="col-sm-2 col-form-label">Company</label>
              <div class="col-sm-7">
                  <select class="custom-select{{ $errors->has('company') ? ' is-invalid' : '' }}" id="inputGroupSelect01" name="company" required>
                    @foreach($companies as $company)
                      <option value="{{$company->id}}">{{$company->name}}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('company'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('company') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <div class="form-group row">
              <label for="password" class="col-sm-2 col-form-label">{{ __('Password') }}</label>

              <div class="col-sm-7">
                  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                  @if ($errors->has('password'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <div class="form-group row">
              <label for="password-confirm" class="col-sm-2 col-form-label">{{ __('Confirm Password') }}</label>

              <div class="col-sm-7">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
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
@endif
@endsection
