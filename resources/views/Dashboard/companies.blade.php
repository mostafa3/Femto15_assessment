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
    Here is our companies so we can edit or delete or <button class="btn btn-link"><a href="{{route('new_company')}}">Add New Company</a></button>
  </p>

    @if(count($companies)>0)
          <div class="form-group searchCompaniesTable">
            <input type="text" class="form-control form-control-lg" id="searchInput" aria-describedby="searchHelp" placeholder="Search by Name">
            <small id="searchHelp" class="form-text text-muted">Search in companies at least 3 chars</small>
          </div>
            <table class="table table-hover">
              <thead>
                <th>NAME</th>
                <th>Email</th>
                <th>PHONE</th>
                <th>ADDRESS</th>
                <th></th>
              </thead>
              <tbody>
  @foreach($companies as $company)
    <tr>
      <td class="name">{{$company->name}}</td>
      <td class="email">{{$company->email}}</td>
      <td class="phone">{{$company->tel}}</td>
      <td class="address">{{$company->address}}</td>
      <td><a href="company/{{$company->id}}"><i class="fas fa-external-link-square-alt icon-large"></i></a></td>
    </tr>


  @endforeach

    </tbody>
    </table>


            {{$companies->links()}}
  @else

    NO Patients To Show !

  @endif

  </div>

  <script src="{{ asset('js/companies.js') }}"></script>
  <script>
    $('.sidebar .nav-link[href*="/companies"]').addClass('cur');
  </script>
@endsection
