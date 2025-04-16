<div class="mb-3">
    <label for="name" class="form-label">Tên</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="property_type" class="form-label">Loại hình</label>
    <input type="text" class="form-control @error('property_type') is-invalid @enderror" id="property_type" name="property_type" value="{{ old('property_type') }}">
    @error('property_type')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="address" class="form-label">Địa chỉ</label>
    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}">
    @error('address')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="description" class="form-label">Mô tả</label>
    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
    @error('description')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="short_description" class="form-label">Mô tả ngắn</label>
    <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description">{{ old('short_description') }}</textarea>
    @error('short_description')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="owner_id" class="form-label">Chủ sở hữu</label>
    <select class="form-select @error('owner_id') is-invalid @enderror" id="owner_id" name="owner_id">
        <option value="">-- Chọn Chủ sở hữu --</option>
        @foreach($propertyOwners as $owner)
            <option value="{{ $owner->id }}" {{ old('owner_id') == $owner->id ? 'selected' : '' }}>{{ $owner->name }} ({{ $owner->email }})</option>
        @endforeach
    </select>
    @error('owner_id')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="category_id" class="form-label">Danh mục</label>
    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
        <option value="">-- Chọn Danh mục --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </select>
    @error('category_id')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="images" class="form-label">Images</label>
    <input type="file" class="form-control @error('images') is-invalid @enderror" id="images" name="images[]" multiple> {{-- File input, name="images[]", multiple --}}
    <small class="text-muted">Chọn nhiều ảnh nếu muốn.</small>
    @error('images')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @if(isset($property) && $property->images)
        <div class="mt-2">
            <strong>Ảnh hiện tại:</strong>
            <div class="row">
                @foreach(json_decode($property->images) as $imagePath)
                    <div class="col-md-3 mt-2">
                        <img src="{{ asset('storage/' . $imagePath) }}" alt="Property Image" class="img-thumbnail">
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

{{--<div class="mb-3">--}}
{{--    <label for="videos" class="form-label">Videos (JSON)</label>--}}
{{--    <textarea class="form-control @error('videos') is-invalid @enderror" id="videos" name="videos">{{ old('videos') }}</textarea>--}}
{{--    <small class="text-muted">Nhập JSON array của các URL video.</small>--}}
{{--    @error('videos')--}}
{{--    <div class="invalid-feedback">{{ $message }}</div>--}}
{{--    @enderror--}}
{{--</div>--}}

<div class="mb-3">
    <label for="rule" class="form-label">Rule</label>
    <textarea class="form-control @error('rule') is-invalid @enderror" id="rule" name="rule">{{ old('rule') }}</textarea>
    @error('rule')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="service" class="form-label">Service (JSON)</label>
    <textarea class="form-control @error('service') is-invalid @enderror" id="service" name="service">{{ old('service') }}</textarea>
    <small class="text-muted">Nhập JSON object của dịch vụ.</small>
    @error('service')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="amenities" class="form-label">Amenities (JSON)</label>
    <textarea class="form-control @error('amenities') is-invalid @enderror" id="amenities" name="amenities">{{ old('amenities') }}</textarea>
    <small class="text-muted">Nhập JSON object của tiện nghi.</small>
    @error('amenities')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="room_quantity" class="form-label">Room Quantity</label>
    <input type="number" class="form-control @error('room_quantity') is-invalid @enderror" id="room_quantity" name="room_quantity" value="{{ old('room_quantity') }}">
    @error('room_quantity')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="standard_people_quantity" class="form-label">Standard People Quantity</label>
    <input type="number" class="form-control @error('standard_people_quantity') is-invalid @enderror" id="standard_people_quantity" name="standard_people_quantity" value="{{ old('standard_people_quantity') }}">
    @error('standard_people_quantity')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input @error('is_featured') is-invalid @enderror" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
    <label class="form-check-label" for="is_featured">Is Featured</label>
    @error('is_featured')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input @error('is_popular') is-invalid @enderror" id="is_popular" name="is_popular" value="1" {{ old('is_popular') ? 'checked' : '' }}>
    <label class="form-check-label" for="is_popular">Is Popular</label>
    @error('is_popular')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input @error('is_discounted') is-invalid @enderror" id="is_discounted" name="is_discounted" value="1" {{ old('is_discounted') ? 'checked' : '' }}>
    <label class="form-check-label" for="is_discounted">Is Discounted</label>
    @error('is_discounted')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="checkin_time" class="form-label">Check-in Time</label>
    <input type="time" class="form-control @error('checkin_time') is-invalid @enderror" id="checkin_time" name="checkin_time" value="{{ old('checkin_time') }}">
    @error('checkin_time')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="checkout_time" class="form-label">Check-out Time</label>
    <input type="time" class="form-control @error('checkout_time') is-invalid @enderror" id="checkout_time" name="checkout_time" value="{{ old('checkout_time') }}">
    @error('checkout_time')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="deposit_percentage" class="form-label">Deposit Percentage</label>
    <input type="number" class="form-control @error('deposit_percentage') is-invalid @enderror" id="deposit_percentage" name="deposit_percentage" value="{{ old('deposit_percentage') }}" step="0.01" min="0" max="100">
    @error('deposit_percentage')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="cancellation_policy" class="form-label">Cancellation Policy</label>
    <textarea class="form-control @error('cancellation_policy') is-invalid @enderror" id="cancellation_policy" name="cancellation_policy">{{ old('cancellation_policy') }}</textarea>
    @error('cancellation_policy')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
