<?php

namespace App\Actions\TaskAction;

use App\Models\Project;

class ShowTaskProcessAction
{

    /**
     * @param $project_id
     * @return \Illuminate\Database\Eloquent\Collection|mixed|object|null
     */
    public function handle($project_id)
    {
        try {
            return Project::with('tasks')->findOrFail($project_id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Problem finding project with id {$project_id}.");
        }
    }
}
