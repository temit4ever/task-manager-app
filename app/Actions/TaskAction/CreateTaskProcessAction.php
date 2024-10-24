<?php

namespace App\Actions\TaskAction;

use App\Helpers\Task\PriorityConstant;
use App\Models\Project;
use App\Models\Task;

class CreateTaskProcessAction
{
    public function handle(): object
    {
        try {
            return Project::all();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Problem retrieving data for form usage to create task');
        }
    }

}
