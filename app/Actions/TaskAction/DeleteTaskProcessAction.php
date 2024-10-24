<?php

namespace App\Actions\TaskAction;

use App\Models\Task;

class DeleteTaskProcessAction
{
    /**
     * @param $id
     * @return bool
     */
    public function handle($id): bool
    {
        try {
            Task::findOrFail($id)->delete();
            return true;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Problem deleting task');
        }
    }

}
