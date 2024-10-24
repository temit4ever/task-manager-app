<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Project</h1>
        <div class="card card-body bg-light p-4">
            <div class="mb-2 text-primary-emphasis text-2xl">Select a specific project to see associated task(s)</div>
            <form id="viewTaskForm" action="/" method="GET">
                @csrf
                <div class="mb-3">
                    <select name="project_id" id="project-id" class="form-select form-select-lg mb-3">
                        <option selected>Select Project</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('project_id')" class="mt-2"/>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>


<!-- Modal View-->
<div class="modal fade" id="viewTaskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="viewTaskModalLabel">Tasks for Selected Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-info-subtle">
                <ul id="task--list" class="list-group">
                    <!-- Automatically display list of tasks by using the element id to manipulate the DOM -->
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Listen to event for dropdown change
        $('#project-id').on('change', function () {

            const taskListEle = $('#task--list');
            const projectId = $(this).val();
            let showRoute = "{{ route('show.task', ':projectId') }}".replace(':projectId', projectId);

            // Fetch tasks based on the selected project using Fetch API
            fetch(showRoute, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            }).then(response => response.json())
                .then(tasks => {
                    if (tasks.success) {
                        taskListEle.empty();
                        if (tasks.data.length === 0) {
                            taskListEle.append('<li class="list-group-item">No task set yet for this project, try to create one <a href="/tasks"><span class="text-primary">here</span><a></li>')
                        }
                        // Loop through each task and append to the modal
                        tasks.data.forEach(function (task) {
                            taskListEle.append('<li class="list-group-item"><span class="fs-5 text-success">Task:</span> ' + task.name + '  - <span class="fs-5 text-danger">Priority:</span><span class="text-capitalize"> ' + task.priority + '</span></li>');
                        });

                        // Call the modal component to show the modal and the task list on the modal body
                        const myModal = new bootstrap.Modal(document.getElementById('viewTaskModal'), {
                            keyboard: true
                        });

                        myModal.show();

                    }
                }
                ).then(response => console.log(JSON.stringify(response))
            );
        });
    });
</script>

