<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/css/reset.css" />
  <link rel="stylesheet" href="/css/style.css" />
  <title>COACHTECH</title>
</head>
<body>
  <div class="containar">
    <div class="card">
      <div class="card_header">
        <p class=title>タスク検索</p>
        <div class=title_user_name>
          @section('content')
          @if (Auth::check())
          <p class="user_name">{{$user->name .'でログイン中' }}</p>
          <form action="http://127.0.0.1:8000/logout" method="post">
            @csrf
            <input type="submit" class="btn_logout" value="ログアウト">
          </form> 
          @endif
        </div>
      </div>

      <div class="todo">
        <form action="/todos/search" method="get" class="flex between mb_30">
          @csrf
          <input type="text" class="input_add" name="keyword">
          <select class="select_tag" name="tag_id">
            <option disabled selected value=""></option>
            @foreach ($tags as $tag)
            <option value="{{ $tag->id }}" {{ (isset($todo) && $todo->tag_id === $tag->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
            @endforeach
            @foreach ($todos as $todo)
            {{ $todo->tag_id }}
            @endforeach
          </select>
          <input type="submit" class="btn_add" value="検索">
        </form>
        @section('content')
        <table>
          <tbody>
            <tr>
              <th>作成日</th>
              <th>タスク名</th>
              <th>タグ</th>
              <th>更新</th>
              <th>削除</th>
            </tr>
            @foreach ($todos as $todo)
            <tr>
              <td>{{$todo->created_at}}</td>
                <form action="/todos/update" method="POST">
                  @csrf
                <input type="hidden" name="id" value="{{$todo->id}}">
                <td><input type="text" name ="content" class="input_update" value="{{$todo->content}}" ></td>
                <td>
                  <select class="tag_update" name="tag_id">
                      <option value="" selected disabled></option>
                  @foreach ($tags as $tag)
                    @if($todo->tag_id ==  $tag->id)
                      <option value="{{ $tag->id }}" selected >{{ $tag->name }}</option>
                    @else
                      <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endif
                  @endforeach
                  </select>
                </td>
                <td><button type="submit" class="btn_update" value="{{$todo->id}}">更新</button></td>
              </form>
                @section('content')
              <form action="/todos/delete" method="POST">
                  @csrf
                <td>
                  <input type="hidden" name="id" value="{{$todo->id}}">
                  <button type="submit" class="btn_delete" >削除</button>
                </td>
              </form>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <a class="btn_back" href="http://127.0.0.1:8000/">戻る</a>
    </div>    
  </div>
</body>
</html>