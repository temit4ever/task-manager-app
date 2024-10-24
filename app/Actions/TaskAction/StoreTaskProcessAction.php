<?php

namespace App\Actions\TaskAction;

use App\Models\Project;
use App\Models\Task;

class StoreTaskProcessAction
{
    /**
     * @param $taskRequest
     * @return bool
     */
    public function handle($taskRequest)
    {
        try {
            $data = $taskRequest->validated();
            Task::create([
                'name' => $data['task_name'],
                'project_id' =>$data['project_id'],
                'priority' => Task::count() + 1,
            ]);
            return true;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create task.');
        }
    }

}
