<?php

namespace App\Actions\ProjectAction;

use App\Models\Project;

class ShowProjectProcessAction
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function handle()
    {
        try {
            return Project::all();
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Problem retrieving projects');
        }
    }

}
