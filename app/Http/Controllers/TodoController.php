<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller

{
    public function index()
    {
        $todos = Todo::all();
        $user = Auth::user();
        $tags = Tag::all();

        return view('index', compact('todos', 'user', 'tags'));
    }

    public function create(TodoRequest $request)
    {
        $todo = Todo::create([
        'content' => $request->content,
        'tag_id' => $request->tag_id,
        'user_id' => auth()->id()
        ]);

        return redirect('/');
    }

    public function update(TodoRequest $request, Todo $todo)
    {
        $id = $request->id;
        $todo = Todo::find($id);
        $todo->update([
        'content' => $request->content,
        'tag_id' => $request->tag_id,
        'user_id' => auth()->id()
        ]);

        return back()->withInput();
    }

    public function remove(Request $request)
    {
        Todo::find($request->id)->delete();

        return back()->withInput();
    }

    public function find()
    {
        $todos = array();
        $user = Auth::user();
        $tags = Tag::all();

        return view('search',compact('todos', 'user', 'tags'));
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $tags = Tag::all();
        $keyword = $request->input('keyword');
        $tag_id = $request->input('tag_id');
        $todos = Todo::doSearch($keyword, $tag_id);

        return view('search', compact('user', 'todos', 'tags'));
    }
}
