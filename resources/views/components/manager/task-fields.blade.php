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

<div class="mb-3">
    <label class="form-label" for="taskAssignee">担当者</label>
    <select name="assignee_id" value="{{ old('assignee_id', $task->assignee_id) }}" id="taskAsignee"
        class="form-control @error('assignee_id') is-invalid @enderror">
        <option value="" @selected(empty(old('assignee_id', $task->assignee_id)))>なし</option>

        @foreach ($team->members as $member)
            <option value="{{ $member->user_id }}" @selected(intval(old('assignee_id', $task->assignee_id)) === $member->user_id)>{{ $member->user->name }}</option>
        @endforeach
    </select>
    @error('assignee_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
