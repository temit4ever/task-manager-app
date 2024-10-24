<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Create Project</h1>

        <div class="card card-body bg-light p-4">
            <form id="projectForm" action="{{ route('store.project') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="project_name" class="form-label">Project Name</label>
                    <input class="form-control form-control-lg" id="project_name" type="text" aria-label=".form-control-lg" name="project_name">
                    <x-input-error :messages="$errors->get('project_name')" class="mt-2" />
                </div>
                <div class="mb-3">
                    <label for="project_description" class="form-label">Description</label>
                    <textarea class="form-control form-control-lg" id="project_description" type="text"
                              aria-label=".form-control-lg" name="project_description"></textarea>
                    <x-input-error :messages="$errors->get('project_description')" class="mt-2" />

                </div>
                <x-primary-button class="ms-3">
                    {{ __('Create project') }}
                </x-primary-button>
            </form>
        </div>
    </div>

</x-app-layout>



{{--@push('head')
    <!-- Custom Scripts -->
    <script type="text/javascript" src="{{ asset('js/task/common.js')}}"></script>
@endpush--}}
