<?php

namespace App\Actions\ProjectAction;

use App\Models\Project;

class StoreProjectProcessAction
{
    /**
     * @param $projectRequest
     * @return bool
     */
    public function handle($projectRequest): bool
    {
        try {
            $data = $projectRequest->validated();
            $project = new Project();
            $project->name = $data['project_name'];
            $project->description = $data['project_description'];
            $project->save();
            return true;
        } catch(\Exception $e) {
            return redirect()->back()->with('error', 'Problem persisting project');
        }
    }

}
