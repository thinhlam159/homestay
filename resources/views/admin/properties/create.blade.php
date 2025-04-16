@extends('admin.layouts.admin')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tạo mới Homestay</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data"> {{-- Add enctype --}}
                @csrf
                @include('admin.properties._form') {{-- Include form partial --}}

                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
@endsection
