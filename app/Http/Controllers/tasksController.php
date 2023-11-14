<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
class tasksController extends Controller
{

    //index muestra todoas las tareas
    public function index()
    {
        $tasks = Task::all();
        $categories = Category::all();
        $tasks = Task::orderBy("created_at","asc")->paginate(10);
        return view("tasks.index", ["tasks"=> $tasks,"categories"=> $categories]);
    }
    //guardar ls tareas
    public function store(Request $request)
    {
        $request->validate([
            "title"=> "required|min:6",
        ]);

        $task = new Task();
        $task->title = $request->title;
        $task->category_id = $request->category_id;
        $task->save();
        return redirect()->route("tasks")->with("success","Task created succesfully");
    }
    //mostrar uno
    public function show($id){

        $task = Task::find($id);
        return view("tasks.show", ["task"=> $task]);

    }
    //actualizar las tareas
    public function update(Request $request, $id)
     {
        $task = Task::find( $id);
        $task->title = $request->title;
        $task->update();
        return redirect()->route("tasks")->with("success","Updated succesfully");
    }
    //eliminar las tareas
    public function destroy($id)
    {

        $task = Task::find($id);
        $task->delete();
        return redirect()->route("tasks")->with("success","Deleted succesfully");
    }
    //mostrar el formulario de edicion
    public function edit($id){

    }
}
