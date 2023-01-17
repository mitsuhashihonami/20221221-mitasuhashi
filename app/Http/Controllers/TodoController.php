<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $todos = Todo::paginate(4);
        $param = ['todos' => $todos, 'user' => $user];

        return view('index', $param);
    }



    public function create(TodoRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        Todo::create($form);
        return redirect('/home');
    }


    public function update(Request $request)
    {
        $form = $request->all();
        unset($form['_token']);
        Todo::where('id', $request->id)->update($form);
        return redirect('/home');

    }

    public function delete(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/home');

    }
}
