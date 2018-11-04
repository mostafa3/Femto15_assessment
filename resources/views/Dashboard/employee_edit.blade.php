@extends('layouts.dashboard')


@section('content')
@include('inc.sidebar')





      <div class='container'>
        <div class="row justify-content-center">
          <div class="col-lg-8 ">
            @include('inc.messages')
          </div>
        </div>
        @if($employee)

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Are you sure to delete this employee ?
              </div>
              <div class="modal-footer">
                {!!Form::open(['action' => ['AdminController@delete_employee','id' => $employee->id],'method' => 'delete'])!!}
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                {!!Form::close()!!}
              </div>
            </div>
          </div>
        </div>


        <div class="">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('employees')}}">Employees</a></li>
            <li class="breadcrumb-item"><a href="{{route('edit_employee',$employee->id)}}">{{$employee->name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
          </ol>
        </nav>
      </div>

      {!!Form::open(['action' => ['AdminController@update_employee', 'id' => $employee->id], 'method' => 'PUT'])!!}
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>

                    <div class="col-sm-7">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $employee->name }}" required autofocus>

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
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $employee->email }}" required>

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
                        <input id="phone" type="number" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $employee->phone }}" required>

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
                      <select class="custom-select{{ $errors->has('company') ? ' is-invalid' : '' }}" id="company" name="company" required>
                        @foreach($companies as $company)
                          @if($company->id == $employee->company->id)
                            <option value="{{$company->id}}" selected>{{$company->name}}</option>
                          @else
                            <option value="{{$company->id}}">{{$company->name}}</option>
                          @endif
                        @endforeach
                      </select>

                        @if ($errors->has('company'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('company') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <a href="change_password/{{$employee->id}}">Change Password</a>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update') }}
                        </button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Delete </button>
                    </div>
                </div>

      {!! Form::close() !!}
      @else
      <h2>employee not found</h2>
      @endif
      </div> <!-- Container -->


@endsection
