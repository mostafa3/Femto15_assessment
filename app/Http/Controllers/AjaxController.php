<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Company;


class AjaxController extends Controller
{

     public function __construct()
     {
         $this->middleware('auth:admin');
     }


    public function employee_search(Request $request){
      $users = User::where('name','LIKE','%'.$request->search.'%')->get();
      foreach($users as $user){
        $user->company_name = $user->company->name;
      }
      return response()->json(['data' => $users]);
    }

    public function company_search(Request $request){
      $companies = Company::where('name','LIKE','%'.$request->search.'%')->get();
      return response()->json(['data' => $companies]);
    }


}
