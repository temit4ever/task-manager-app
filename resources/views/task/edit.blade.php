<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Create Task</h1>
        <div class="card card-body bg-light p-4">
            <form action="{{ route('update.task', $task->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="task_name" class="form-label">Task Name</label>
                    <input class="form-control form-control-lg" id="task_name" type="text" aria-label=".form-control-lg"
                           name="task_name"  value="{{ $task->name }}">
                    <x-input-error :messages="$errors->get('task_name')" class="mt-2" />

                </div>
                <div class="mb-3">
                    <label for="project_name" class="form-label">Project Name</label>
                    <select name="project_id"  id="priority" class="form-select form-select-lg mb-3">
                        <option selected>Select Project</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id  }}" {{ $task->project->id == $project->id  ? 'selected' : '' }}>{{ $project->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('project_name')" class="mt-2" />
                </div>
                <x-primary-button class="ms-3">
                    {{ __('Update task') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
