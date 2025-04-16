<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PermissionServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    protected PermissionServiceInterface $permissionService;

    public function __construct(PermissionServiceInterface $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function index()
    {
        $permissions = $this->permissionService->getAllPermissions();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:permissions,slug',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $this->permissionService->createPermission($request->all());
        return redirect()->route('admin.permissions.index')->with('success', 'Quyền đã được tạo thành công.');
    }

    public function edit(string $id)
    {
        $permission = $this->permissionService->getPermissionById($id);
        if (!$permission) {
            return redirect()->route('admin.permissions.index')->with('error', 'Không tìm thấy quyền.');
        }
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:permissions,slug,' . $id,
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (!$this->permissionService->updatePermission($id, $request->all())) {
            return redirect()->route('admin.permissions.index')->with('error', 'Không thể cập nhật quyền.');
        }
        return redirect()->route('admin.permissions.index')->with('success', 'Quyền đã được cập nhật thành công.');
    }

    public function destroy(string $id)
    {
        if (!$this->permissionService->deletePermission($id)) {
            return redirect()->route('admin.permissions.index')->with('error', 'Không thể xóa quyền.');
        }
        return redirect()->route('admin.permissions.index')->with('success', 'Quyền đã được xóa thành công.');
    }
}
