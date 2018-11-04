<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Company;
use App\Rules\EmailDomain;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth:admin');

  }

  public function dashboard(){
    return 'dashboard';
  }

  public function employees(){
    $employees = User::paginate(15);
    return view('dashboard.employees')->with('employees',$employees);
  }

  public function new_employee_form(){
    $companies = Company::all();
    if(!$companies()->first())
      return redirect(route('new_company_form'));
    return view('Dashboard.employees_new')->with('companies',$companies);
  }

  public function create_employee(Request $request){
    $this->validate($request, [
        'name' => 'required|string|max:255',
        'email' => ['required','string','email','max:255','unique:users',new EmailDomain],
        'password' => 'required|string|min:6|confirmed',
        'phone' => 'required|numeric|digits_between:10,15|unique:users',
        'company' => 'required|numeric|exists:companies,id',
    ]);
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'company_id' => $request->company,
        'password' => Hash::make($request->password),
    ]);
    return redirect('admin/employees')->with('success','Employee created successfully');
  }

  public function edit_employee_form($id){
    $employee = User::find($id);
    $companies = Company::all();
    return view('Dashboard.employee_edit')->with(['employee' => $employee , 'companies' => $companies]);
  }

  public function update_employee(Request $request){
    $employee = User::find($request->id);
    if($employee){
      $this->validate($request,[
        'name' => 'required|string|max:255',
        'email' => ['required','string','email','max:255',new EmailDomain],
        'phone' => 'required|numeric|digits_between:10,15',
        'company' => 'required|numeric|exists:companies,id',
      ]);
      // must choose unique email if email changed
      if($request->email != $employee->email)
        $this->validate($request,[
          'email' => 'unique:users'
        ]);
        // must choose unique email if email changed
      if($request->phone != $employee->phone)
        $this->validate($request,[
          'phone' => 'unique:users'
        ]);

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->company_id = $request->company;

        $employee->save();
        return redirect('admin/employee/'.$employee->id)->with('success','Employee updated');
    }else {
      return 'not found';
    }


  }

  public function change_password_form($id){
    $employee = User::find($id);
    return view('Dashboard.change_password')->with('employee',$employee);
  }

  public function updatePassword(Request $request){
    $this->validate($request,[
      'password' => 'required|string|min:6|confirmed'
    ]);
    $employee = User::find($request->id);
    if($employee){
      $employee->password = Hash::make($request->password);
      $employee->save();
      return redirect('admin/employee/'.$request->id)->with('success','Password Updated');
    }else{
      return 'not found';
    }
  }

  public function delete_employee(Request $request){
    $employee = User::find($request->id);
    if($employee){
      $employee->delete();
      return redirect('admin/employees')->with('success','User has been Deleted');
    }else{
      return 'user not found';
    }
  }

  // crud for companies

  public function companies(){
    $companies = Company::paginate(15);
    return view('dashboard.companies')->with('companies',$companies);
  }

  public function new_company_form(){
    return view('Dashboard.company_new');
  }

  public function create_company(Request $request){
    $this->validate($request, [
        'name' => 'required|string|max:255|unique:companies',
        'email' => 'required|string|email|max:255|unique:companies',
        'tel' => 'required|numeric|digits_between:10,15|unique:companies',
        'address' => 'required|string',
    ]);
    Company::create([
        'name' => $request->name,
        'email' => $request->email,
        'tel' => $request->tel,
        'address' => $request->address,
    ]);
    return redirect('admin/companies')->with('success','Company created successfully');
  }

  public function edit_company_form($id){
    $company = Company::find($id);
    return view('Dashboard.company_edit')->with('company' , $company);
  }

  public function update_company(Request $request){
    $company = Company::find($request->id);
    if($company){
      $this->validate($request,[
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'tel' => 'required|numeric|digits_between:10,15',
        'address' => 'required|string',
      ]);
      // must choose unique name if name changed
      if($request->name != $company->name)
        $this->validate($request,[
          'name' => 'unique:companies'
        ]);
        // must choose unique email if email changed
      if($request->email != $company->email)
        $this->validate($request,[
          'email' => 'unique:companies'
        ]);
        // must choose unique tel if tel changed
      if($request->tel != $company->tel)
        $this->validate($request,[
          'phone' => 'unique:companies'
        ]);

        $company->name = $request->name;
        $company->email = $request->email;
        $company->tel = $request->tel;
        $company->address = $request->address;

        $company->save();
        return redirect('admin/company/'.$company->id)->with('success','Company has been updated');
    }else{
      return 'not found';
    }

  }

  public function delete_company(Request $request){
    $company = Company::find($request->id);
    if($company){
      // canot delete company if it has employee
      if($company->users()->first()){
        return redirect('admin/companies')->withErrors(['The Company has employees it canot be deleted']);
      }
      $company->delete();
      return redirect('admin/companies')->with('success', 'Company has been deleted');
    }else{
      return 'company not found';
    }
  }





}
