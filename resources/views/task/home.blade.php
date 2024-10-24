<x-app-layout>
    <div>
            <div class="container mx-auto px-4 py-8">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                       {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            <div class="float-start">
                <h4 class="pb-3">My Tasks</h4>
            </div>
            <div class="float-end pb-3">
            </div>
            <div class="clearfix"></div>
            <div class="float-end mb-2">

                @if(count($project) > 0)
                <a href="{{ route('create.task') }}" class="btn btn-sm btn-info ">Create Task</a>
                @endif
                <a href="{{ route('create.project') }}" class="btn btn-sm btn-secondary">Create project</a>
            </div>
            <div class="clearfix"></div>
        </div>


    @if($tasks->isNotEmpty())
        <ul id="sortable" class="list-group">
            @foreach($tasks as $task)
                <div class="list-group-item d-flex justify-content-between align-items-center" data-id="{{ $task->id }}">
                    <h5 class="text-break">{{ $task->name }} </h5>
                        <div>
                            <a href="{{ route('show.project') }}" class="btn btn-sm btn-primary">View Project</a>
                            <a href="{{ route('edit.task', $task->id) }}" class="btn btn-sm btn-success">Edit</a>
                        <form action="{{ route('delete.task', $task->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </ul>
    @else
        <p class="text-indigo-700 fs-5">No tasks available. You must create a project first then you can create a task</p>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="projectModalLabel">Add new project</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="projectForm" action="{{ route('store.project') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="project_name" class="form-label">Project Name</label>
                            <input class="form-control form-control-lg" id="project_name" type="text" aria-label=".form-control-lg" name="project_name">
                            <x-input-error :messages="$errors->get('project_name')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <label for="proj_description" class="form-label">Description</label>
                            <textarea class="form-control" id="proj_description" name="proj_description"></textarea>
                            <x-input-error :messages="$errors->get('project_name')" class="mt-2" />
                        </div>

                        <div class="modal-footer">
                            <x-primary-button class="ms-3">
                                {{ __('Submit') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        <!-- Custom Scripts -->
        $(function() {
            $('#sortable').sortable({
                update: function(event, ui) {
                    const taskOrder = $(this).sortable('toArray', { attribute: 'data-id' });
                    fetch('{{ route('reorder.task') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({  tasks: taskOrder })
                    }).then(response => response.json())
                        .then(data => console.log(data))
                        .catch(error => console.error('Error:', error));
                }
            });
        });
    </script>
</x-app-layout>
