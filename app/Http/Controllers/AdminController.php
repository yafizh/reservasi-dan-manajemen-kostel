<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admin = User::where('status', 1)->get();
        return view('dashboard.pages.admin.index', compact('admin'));
    }

    public function create()
    {
        return view('dashboard.pages.admin.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $validatedData['password']  = bcrypt($validatedData['password']);
        $validatedData['status']    = 1;
        User::create($validatedData);

        return redirect('/admin')->with('success', 'Berhasil menambah data admin!');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $admin)
    {
        return view('dashboard.pages.admin.update', compact('admin'));
    }

    public function update(Request $request, User $admin)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $update = [
            'username' => $validatedData['username']
        ];

        if ($validatedData['password'] != $admin->password)
            $update['password'] = bcrypt($validatedData['password']);

        User::where('id', $admin->id)->update($validatedData);

        return redirect('/admin')->with('success', 'Berhasil memperbaharui data admin!');
    }

    public function destroy(User $admin)
    {
        User::destroy($admin->id);
        return redirect('/admin')->with('success', 'Berhasil menghapus data admin!');
    }
}
