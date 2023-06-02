<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('name')
            ->get()
            ->map(function ($employee) {
                $birthDate = new Carbon($employee->birth_date);
                $employee->birth_date = "{$birthDate->day} {$birthDate->locale('ID')->getTranslatedMonthName()} {$birthDate->year}";
                return $employee;
            });

        return view('dashboard.pages.employee.index', compact('employees'));
    }

    public function create()
    {
        return view('dashboard.pages.employee.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_number'     => 'required',
            'name'          => 'required',
            'phone_number'  => 'required',
            'birth_place'   => 'required',
            'birth_date'    => 'required',
            'password'      => 'required',
        ]);

        Employee::create([
            'user_id' => User::create([
                'username'  => $validatedData['id_number'],
                'password'  => bcrypt($validatedData['password']),
                'status'    => 2
            ])->id,
            'id_number'     => $validatedData['id_number'],
            'name'          => $validatedData['name'],
            'phone_number'  => $validatedData['phone_number'],
            'birth_place'   => $validatedData['birth_place'],
            'birth_date'    => $validatedData['birth_date'],
        ]);

        return redirect('/employees')->with('success', 'Berhasil menambah data pegawai!');
    }

    public function show(Employee $employee)
    {
        //
    }

    public function edit(Employee $employee)
    {
        return view('dashboard.pages.employee.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validatedData = $request->validate([
            'id_number'     => 'required',
            'name'          => 'required',
            'phone_number'  => 'required',
            'birth_place'   => 'required',
            'birth_date'    => 'required',
            'password'      => 'required',
        ]);

        $updateUser = [
            'username'      => $validatedData['id_number']
        ];

        $updateEmployee = [
            'id_number'     => $validatedData['id_number'],
            'name'          => $validatedData['name'],
            'phone_number'  => $validatedData['phone_number'],
            'birth_place'   => $validatedData['birth_place'],
            'birth_date'    => $validatedData['birth_date'],
        ];

        if ($validatedData['password'] != $employee->user->password)
            $updateUser['password'] = bcrypt($validatedData['password']);

        User::where('id', $employee->user->id)->update($updateUser);
        Employee::where('id', $employee->id)->update($updateEmployee);

        return redirect('/employees')->with('success', 'Berhasil memperbaharui data pegawai!');
    }

    public function destroy(Employee $employee)
    {
        Employee::destroy($employee->id);
        User::destroy($employee->user->id);

        return redirect('/employees')->with('success', 'Berhasil menghapus data pegawai!');
    }
}
