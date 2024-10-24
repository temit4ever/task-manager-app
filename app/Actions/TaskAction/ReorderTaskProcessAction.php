<?php

namespace App\Actions\TaskAction;

use App\Models\Task;

class ReorderTaskProcessAction
{
    public function handle($request)
    {
        try {
            foreach ($request->tasks as $index => $id) {
                $task = Task::findOrFail($id);
                $task->priority = $index + 1;
                $task->update();
            }
            return true;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to reorder tasks: ' . $e->getMessage()], 500);
        }
    }

}
