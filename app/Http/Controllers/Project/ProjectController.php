<?php

namespace App\Http\Controllers\Project;

use App\Actions\ProjectAction\ShowProjectProcessAction;
use App\Actions\ProjectAction\StoreProjectProcessAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Project\ProjectRequest;

class ProjectController extends Controller
{
    public function __construct(
        protected StoreProjectProcessAction $storeProject,
        protected ShowProjectProcessAction  $showProject) {}

    public function store(ProjectRequest $projectRequest)
    {
        $this->storeProject->handle($projectRequest);
        return redirect()->route('index.task')->with('message', 'New project has been created successfully!');
    }

    public function create()
    {
        return view('project.create');
    }

    public function show()
    {
        $projects = $this->showProject->handle();
        return view('project.show', compact('projects'));;
    }
}
