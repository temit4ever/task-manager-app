<?php

namespace App\Actions\TaskAction;

use App\Models\Project;
use App\Models\Task;

class IndexTaskProcessAction
{
    /**
     * @return array
     */
    public function handle(): array
    {
        try {
            return [
                'tasks' =>Task::orderBy('priority')->get(),
                'projects' => Project::getOneProjectId() // Using scope here
                ];
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Problem retrieving data for list of tasks');
        }
    }
}
