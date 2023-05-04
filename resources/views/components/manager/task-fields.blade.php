<div class="mb-3">
    <label class="form-label" for="taskTitle">タイトル</label>
    <input type="text" name="title" value="{{ old('title', $task->title) }}" id="taskTitle"
        class="form-control @error('body') is-invalid @enderror">
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="taskBody">内容</label>
    <textarea name="body" id="taskBody" class="form-control @error('body') is-invalid @enderror">{{ old('body', $task->body) }}</textarea>
    @error('body')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
