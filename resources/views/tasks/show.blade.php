<x-layout>
    <x-slot name="title">担当タスク</x-slot>
    @if ($task->isFinished())
        <div class="alert alert-info">
            このタスクは完了しました
        </div>
    @endif

    <h2>{{ $task->team->name }} / {{ $task->title }}</h2>
    <x-form-error />
    <x-mini-panel>
        <h3>内容</h3>
        {{ $task->body }}

        <h3>コメント</h3>
        @foreach ($comments as $comment)
            <div>{!! nl2br(e($comment->message)) !!}</div>
            <div>{{ $comment->created_at }} by {{ $comment->author->name }}</div>
            <hr>
        @endforeach


        <form action="{{ route('tasks.comments.store', $task) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label" for="commentMessage">本文</label>
                <textarea name="message" id="commentMessage" class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            @if (!$task->isFinished())
                <div class="mb-3">
                    <label for="kind">完了報告とする</label>
                    <input type="checkbox" name="kind" id="status" value="1">
                </div>
            @endif
            <input type="submit" value="送信" class="btn btn-primary">
        </form>

    </x-mini-panel>
</x-layout>
