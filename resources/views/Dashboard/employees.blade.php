@extends('layouts.dashboard')


@section('content')
@include('inc.sidebar')
<div class="content">
<div class="row justify-content-center">
  <div class="col-lg-8 ">
    @include('inc.messages')
    @include('inc.errors')
  </div>
</div>

  <p class="lg">
    Here is our registerd employees so we can edit or delete or <button class="btn btn-link"><a href="/Femto15/public/admin/employees/new">Add New Employee</a></button>
  </p>

    @if(count($employees)>0)
          <div class="form-group searchEmployeesTable">
            <input type="text" class="form-control form-control-lg" id="searchInput" aria-describedby="searchHelp" placeholder="Search by Name">
            <small id="searchHelp" class="form-text text-muted">Search in your employees at least 3 chars</small>
          </div>
            <table class="table table-hover">
              <thead>
                <th>NAME</th>
                <th>Email</th>
                <th>PHONE</th>
                <th>COMPANY</th>
                <th></th>
              </thead>
              <tbody>
  @foreach($employees as $employee)
    <tr>
      <td class="name">{{$employee->name}}</td>
      <td class="email">{{$employee->email}}</td>
      <td class="phone">{{$employee->phone}}</td>
      <td class="company">{{$employee->company->name}}</td>
      <td><a href="employee/{{$employee->id}}"><i class="fas fa-external-link-square-alt icon-large"></i></a></td>
    </tr>


  @endforeach

    </tbody>
    </table>


            {{$employees->links()}}
  @else

    NO Patients To Show !

  @endif

  </div>

  <script src="{{ asset('js/employees.js') }}"></script>
  <script>
    $('.sidebar .nav-link[href*="/employees"]').addClass('cur');
  </script>
@endsection
