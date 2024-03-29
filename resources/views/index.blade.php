<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TodoList</title>
  <link rel="stylesheet" href="public/css/reset.css">
  <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
  @extends('todo.default')

  @section('content')


  <div class="body">
    <div class="card">
      <div class="flex">
        <h2 class="ttl">Todo List</h2>
        @if (Auth::check())
        <p class="flex_end">「{{$user->name}}」でログイン中</p>
        @else
        <p class="flex_end">ログインしてください。（<a href="/login">ログイン</a>｜
          <a href="/register">登録</a>）
        </p>
        @endif
        <form method="POST" action="{{ route('logout') }}">
          @csrf

          <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
            {{ __('ログアウト') }}
          </x-responsive-nav-link>
        </form>
      </div>
      <form action="{{ route('todo.create') }}" method="post">
        @csrf
        <input type="text" class="create" name="name">
        <input type="submit" class="create__btn" name="btn_name" value="追加">
        @if($errors->has('name'))
        @foreach($errors->get('name') as $message)
        {{ $message }}<br>
        @endforeach
        @endif
      </form>
      <table class="table">
        <tr>
          <th class="padding1">作成日</th>
          <th class="padding1">タスク名</th>
          <th class="padding2">更新</th>
          <th class="padding2">削除</th>
        </tr>
        @foreach ($todos as $todo)
        <tr>
          <td class="padding1">{{ $todo->created_at }}</td>
          <form action="{{ route('todo.update',$todo->id) }}" method="POST">
            @csrf
            <td class="padding1"><input type="text" name="name" class="update_value" value="{{ $todo->name }}"></td>
            <td class="padding2">
              <button type="submit" class="update_btn">更新</button>
            </td>
          </form>

          <form action="{{ route('todo.delete',$todo->id) }}" method="POST">
            @csrf
            <td class="padding2">
              <button type="submit" class="delete_btn">削除</button>
            </td>
          </form>

        </tr>
        @endforeach
      </table>
    </div>
  </div>
  @endsection
</body>

</html>