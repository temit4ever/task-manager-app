<?php

namespace App\Actions\TaskAction;

use App\Helpers\Task\PriorityConstant;
use App\Models\Project;
use App\Models\Task;

class EditTaskProcessAction
{
    /**
     * @param $id
     * @return array
     */
    public function handle($id): array
    {
        try {
            return [
                'task' => Task::with('project')->findOrFail($id),
                'project' => Project::all()
            ];

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Problem retrieving data for form usage to edit task');
        }
    }

}
