<div class="mb-3">
    <label class="form-label" for="teamName">名前</label>
    <input type="text" name="name" value="{{ old('name', $team->name) }}" id="teamName"
        class="form-control @error('name') is-invalid @enderror">
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
