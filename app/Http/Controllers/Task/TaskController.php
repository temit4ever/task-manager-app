<?php

namespace App\Http\Controllers\Task;

use App\Actions\TaskAction\CreateTaskProcessAction;
use App\Actions\TaskAction\DeleteTaskProcessAction;
use App\Actions\TaskAction\EditTaskProcessAction;
use App\Actions\TaskAction\IndexTaskProcessAction;
use App\Actions\TaskAction\ReorderTaskProcessAction;
use App\Actions\TaskAction\ShowTaskProcessAction;
use App\Actions\TaskAction\StoreTaskProcessAction;
use App\Actions\TaskAction\UpdateTaskProcessAction;
use App\Helpers\Task\PriorityConstant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskRequest;
use App\Models\Task;
use Illuminate\Container\Container;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(
        protected CreateTaskProcessAction $createTask,
        protected StoreTaskProcessAction $storeTask,
        protected EditTaskProcessAction $editTask,
        protected DeleteTaskProcessAction $deleteTask,
        protected IndexTaskProcessAction $indexTask,
        protected UpdateTaskProcessAction $updateTask,
        protected ShowTaskProcessAction  $showTask,
        protected ReorderTaskProcessAction $reorderTask
    )
    {
    }

    /**
     * @return Container|mixed|object
     */
    public function index()
    {
        $tasks_project = $this->indexTask->handle();
        $tasks = $tasks_project['tasks'];
        $project = $tasks_project['projects'];
        return view('task.home', compact('tasks', 'project'));
    }

    /**
     * @return Container|mixed|object
     */
    public function create()
    {
        $projects = $this->createTask->handle();
        return view('task.create', compact( 'projects'));
    }

    /**
     * @param TaskRequest $taskRequest
     * @return mixed
     */
    public function store(TaskRequest $taskRequest): mixed
    {
        $this->storeTask->handle($taskRequest);
        return redirect()->route('index.task')->with('success', 'New task has been created successfully!');
    }

    /**
     * @param $task
     * @return Container|mixed|object
     */
    public function edit($task)
    {
        $tasks_project = $this->editTask->handle($task);
        $task = $tasks_project['task'];
        $projects = $tasks_project['project'];
        return view('task.edit', compact('task', 'projects'));
    }

    /**
     * @param $project
     * @return mixed
     */
    public function show($project): mixed
    {
        $projects = $this->showTask->handle($project);
        return response()->json(['success' => true, 'data' => $projects->tasks]);
    }

    /**
     * @param TaskRequest $taskRequest
     * @param $task
     * @return mixed
     */

    public function update(TaskRequest $taskRequest, $task): mixed
    {
        $this->updateTask->handle($taskRequest, $task);
        return redirect()->route('index.task')->with('success', 'Task has been updated successfully!');
    }

    /**
     * @param $task
     * @return mixed
     */
    public function destroy($task): mixed
    {
       $this->deleteTask->handle($task);
        return redirect()->route('index.task')->with('success', 'Task has been deleted successfully!');
    }

    /**
     * @param TaskRequest $taskRequest
     * @return mixed
     */
    public function reorder(Request $request):mixed
    {
        $this->reorderTask->handle($request);
        return response()->json(['success' => 'Tasks reordered successfully']);
    }


}
