<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
                {{ __('Tasks') }}
            </h2>
            <a href="{{ route('tasks.create') }}" class=" inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Create Task
            </a>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <h3 class="text-lg font-semibold mb-4">Task List</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200" id="Tasks-Table">
                            <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                            </thead>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(function () {
            var table = $('#Tasks-Table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('tasks.index') }}",
                columns: [
                    {data: 'title', name: 'title'},
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, full, meta) {
                            // Convert timestamp to a relative time format
                            return moment(data).fromNow();
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            return data;
                        }
                    }
                ]
            });
        });
    </script>
</x-app-layout>
