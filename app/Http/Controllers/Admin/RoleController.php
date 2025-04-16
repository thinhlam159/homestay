<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PermissionServiceInterface;
use App\Services\RoleServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    protected RoleServiceInterface $roleService;

    public function __construct(RoleServiceInterface $roleService, PermissionServiceInterface $permissionService)
    {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }

    public function index()
    {
        $roles = $this->roleService->getAllRoles();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:roles,slug', // Slug không bắt buộc, tự tạo, nhưng nếu có thì phải unique
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $this->roleService->createRole($request->all());
        return redirect()->route('admin.roles.index')->with('success', 'Vai trò đã được tạo thành công.');
    }

    public function edit(string $id)
    {
        $role = $this->roleService->getRoleById($id);
        if (!$role) {
            return redirect()->route('admin.roles.index')->with('error', 'Không tìm thấy vai trò.');
        }
        $permissions = $this->permissionService->getAllPermissions(); // Fetch all permissions
        return view('admin.roles.edit', compact('role', 'permissions')); // Pass permissions to view
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:roles,slug,' . $id, // Slug không bắt buộc, tự tạo, nhưng nếu có thì phải unique, bỏ qua bản ghi hiện tại
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $role = $this->roleService->getRoleById($id); // Get the Role
        if (!$role) {
            return redirect()->route('admin.roles.index')->with('error', 'Không tìm thấy vai trò.');
        }

        $data = $request->except('permissions', '_method', '_token'); // Exclude permissions from basic update data
        if (!$this->roleService->updateRole($id, $data)) {
            return redirect()->route('admin.roles.index')->with('error', 'Không thể cập nhật vai trò.');
        }
        $permissions = $request->input('permissions', []); // Get selected permission IDs from request
        $role->permissions()->sync($permissions); // Sync permissions for the role

        return redirect()->route('admin.roles.index')->with('success', 'Vai trò đã được cập nhật thành công.');
    }

    public function destroy(string $id)
    {
        if (!$this->roleService->deleteRole($id)) {
            return redirect()->route('admin.roles.index')->with('error', 'Không thể xóa vai trò.');
        }
        return redirect()->route('admin.roles.index')->with('success', 'Vai trò đã được xóa thành công.');
    }
}
