<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\RoleServiceInterface;
use App\Services\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService, RoleServiceInterface $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'phone' => 'nullable|string|max:255',
            'fb' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $this->userService->createUser($request->all());
        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được tạo thành công.');
    }

    public function edit(string $id)
    {
        $user = $this->userService->getUserById($id);
        if (!$user) {
            return redirect()->route('admin.users.index')->with('error', 'Không tìm thấy người dùng.');
        }
        $roles = $this->roleService->getAllRoles();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed', // Password không bắt buộc khi update
            'phone' => 'nullable|string|max:255',
            'fb' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = $this->userService->getUserById($id); // Get the User

        if (!$user) {
            return redirect()->route('admin.users.index')->with('error', 'Không tìm thấy người dùng.');
        }

        $data = $request->except('roles', 'password_confirmation', '_method', '_token'); // Exclude roles from basic update data
        if ($request->filled('password')) { // Only update password if provided
            $data['password'] = $request->password;
        }

        if (!$this->userService->updateUser($id, $data)) { // Update basic user data
            return redirect()->route('admin.users.index')->with('error', 'Không thể cập nhật người dùng.');
        }

        $roles = $request->input('roles', []); // Get selected role IDs from request
        $user->roles()->sync($roles); // Sync roles for the user

        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được cập nhật thành công.');
    }

    public function destroy(string $id)
    {
        if (!$this->userService->deleteUser($id)) {
            return redirect()->route('admin.users.index')->with('error', 'Không thể xóa người dùng.');
        }
        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được xóa thành công.');
    }
}
