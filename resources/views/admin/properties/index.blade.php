@extends('admin.layouts.admin')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản lý Homestay</h1>
        <a href="{{ route('admin.properties.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tạo mới
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Loại hình</th>
                        <th>Địa chỉ</th>
                        <th>Chủ sở hữu</th>
                        <th>Danh mục</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($properties as $property)
                        <tr>
                            <td>{{ $property->id }}</td>
                            <td>{{ $property->name }}</td>
                            <td>{{ $property->property_type }}</td>
                            <td>{{ $property->address }}</td>
                            <td>{{ $property->owner->name ?? 'N/A' }}</td> {{-- Display owner name --}}
                            <td>{{ $property->category->name ?? 'N/A' }}</td> {{-- Display category name --}}
                            <td>
                                <a href="{{ route('admin.properties.edit', $property->id) }}" class="btn btn-sm btn-primary">Sửa</a>
                                <form action="{{ route('admin.properties.destroy', $property->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
