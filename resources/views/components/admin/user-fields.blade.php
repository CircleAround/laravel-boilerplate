<div>
  <label>名前</label>
  <input type="text" name="name" value="{{ old('name', $user->name) }}">
</div>
<div>
  <label>メールアドレス</label>
  <input type="text" name="email" value="{{ old('email', $user->email) }}">
</div>
