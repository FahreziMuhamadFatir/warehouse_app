<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('users.index', compact('users'));
    }

    // Menampilkan form create user
        public function create()
    {
        return view('users.create');
    }

    // Menyimpan data user
        public function store(Request $request)
    {
        // Validasi input
       $request->validate([
        'name' => 'required|string|max:255',
        'fullname' => 'required|string|max:50',
        'email' => 'required|email|unique:users,email',
        'usertype' => 'required|string|max:50',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

        // Upload foto jika ada
        $photoName = 'default.png';
        if ($request->hasFile('photo')) {
            $photoName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/user'), $photoName);
        }

        // Simpan ke database
        User::create([
            'name' => $request->name,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'usertype' => $request->usertype,
            'password' => Hash::make($request->password),
            'photo' => $photoName,
        ]);

        return redirect()->route('users.create')->with('success', 'User berhasil ditambahkan.');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Proses update
    public function update(Request $request, $id)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'fullname' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'usertype' => 'required|string',
        'password' => 'nullable|string|min:6|confirmed',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user = User::findOrFail($id);
    $user->name = $request->name;
    $user->fullname = $request->fullname;
    $user->email = $request->email;
    $user->usertype = $request->usertype;

    if ($request->password) {
        $user->password = bcrypt($request->password);
    }

    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/user'), $filename);
        $user->photo = $filename;
    }

    $user->save();

    return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Jika ada foto, bisa hapus file juga (opsional)
        if ($user->photo && file_exists(public_path('storage/photos/' . $user->photo))) {
            unlink(public_path('storage/photos/' . $user->photo));
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }

}
