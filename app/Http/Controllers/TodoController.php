<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoItem;


class TodoController extends Controller
{
    /**
     * 全てのToDoアイテムを表示するメソッド
     */
    public function index()

    {
        $todos = TodoItem::all();

        return view('todo', ['todos' => $todos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * ToDoアイテムを新規作成したらDBに保存するメソッド
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_name' => ['required'],
            'item_description' => ['required'],
        ]);

        $validated = $request->validate([
            'item_name' => 'required|max:25',
            'item_description' => 'required|max:50',
        ]);

        $todo = new TodoItem();
        $todo->item_name = $request->input('item_name');
        $todo->user_id = auth()->user()->id;
        $todo->created_at = now();
        $todo->item_description = $request->input('item_description');
        $todo->save();

        return redirect(route('todo'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * ToDoの編集ボタンを押したらeditページに移動するメソッド
     */
    public function edit(TodoItem $todo)
    {
        return view('edit', ['todo' => $todo]);
    }

    /**
     * ToDoアイテムを編集して確定ボタンを押したらDBに保存するメソッド
     */
    public function updateEdit(Request $request, TodoItem $todo)
    {
        $request->validate([
            'item_name' => ['required'],
            'item_description' => ['required'],
        ]);

        $validated = $request->validate([
            'item_name' => 'required|max:25',
            'item_description' => 'required|max:50',
        ]);

        $todo->item_name = $request->item_name;
        $todo->item_description = $request->item_description;
        $todo->save();

        return redirect()->route('todo');
    }


    /**
     * ToDoの完了ボタンを押したらDBのdoneの値が切り替わるメソッド
     */
    public function updateDone(Request $request, TodoItem $todo)
    {
        $todo->update([
            'done' => !$todo->done,
        ]);

        return redirect()->route('todo');
    }
    /**
     * ToDoの削除ボタンを押したらDBに保存されているToDoアイテムを削除するメソッド
     */
    public function destroy(TodoItem $todo)
    {
        $todo->delete();

        return redirect()->route('todo');
    }
}
