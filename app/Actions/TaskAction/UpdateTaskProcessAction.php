<?php

namespace App\Actions\TaskAction;

use App\Models\Task;

class UpdateTaskProcessAction
{
    /**
     * @param $taskRequest
     * @param $id
     * @return bool
     */
    public function handle($taskRequest, $id): bool
    {
        try {
            $data = $taskRequest->validated();
            $task = Task::with('project')->findOrFail($id);
            $task->update([
                'name' => $data['task_name'],
                'project_id' => $data['project_id'],
                'priority' => $task->priority,
            ]);

            return true;

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Problem updating task');
        }
    }
}
