@extends('layouts.dashboard')


@section('content')
@include('inc.sidebar')


      <div class='container'>
        @if($employee)
        <div class="">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('employees')}}">Employees</a></li>
            <li class="breadcrumb-item"><a href="{{route('edit_employee',$employee->id)}}">{{$employee->name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
          </ol>
        </nav>
      </div>
<div class="row justify-content-center">
  <div class="col-lg-8 ">
    @include('inc.messages')
  </div>
</div>


{!!Form::open(['action' => ['AdminController@updatePassword', 'id' => $employee->id], 'method' => 'PUT'])!!}
    <div class="account">

            <div class="form-group row">
              <!-- <label for="password" class="col-sm-2 col-form-label">Password</label> -->
              {!!Form::label('password', 'Password', ['class' => 'col-sm-2 col-form-label'])!!}
              <div class="col-sm-10">
                <!-- <input type="password" class="form-control" id="password" placeholder="Password" name="password"> -->
                {!!Form::password('password',  ['class' => 'form-control', 'placeholder' => 'Password'])!!}
              </div>
            </div>

            <div class="form-group row">
              <!-- <label for="password" class="col-sm-2 col-form-label">Confirm Password</label> -->
              {!!Form::label('password_confirmation', 'Confirm Password', ['class' => 'col-sm-2 col-form-label'])!!}
              <div class="col-sm-10">
                <!-- <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm The Password" name="password_confirmation"> -->
                {!!Form::password('password_confirmation',  ['class' => 'form-control', 'placeholder' => 'Confirm The Password'])!!}
              </div>
            </div>
          </div>

  {{Form::submit('Save',['class' => 'btn btn-primary'])}}

      {!! Form::close() !!}
      @else
      <h2>employee not found</h2>
      @endif
  </div> <!-- Container -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

@endsection
