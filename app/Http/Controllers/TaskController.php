<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Validator;

class TaskController extends Controller
{
    public function index()
    {
        $data = Task::all()->where('date', '>=', NOW());
        return view('task',compact('data'));
    }



    public function update(Request $request)
    {
        if($request->ajax()){
            Task::find($request->input('pk'))->update([$request->input('name') => $request->input('value')]);
            return response()->json(['success' => true]);
        }
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'date' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $task = Task::create($input);

        return \Redirect::route('task');

    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        if(date_diff(new \DateTime($task->date), new \DateTime())->format("%d") > 6) {
            $task->delete();
        } else {
            return $this->sendError('Date diff invalid : ' .date_diff(new \DateTime($task->date), new \DateTime())->format("%d") . 'Days and need more than 6 days', $task->date);
        }

        return \Redirect::route('task');
    }
}
