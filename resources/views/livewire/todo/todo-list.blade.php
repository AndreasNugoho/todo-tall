<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Task List
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Details
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Completed At
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($todos as $todo)
                    <tr>
                        <td class="px-6 py-4">
                            <input wire:click.live='complete({{ $todo->id }})' type="checkbox" id='todo'
                                @if ($todo->completed) checked @else @endif>
                        </td>
                        <td scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if ($todo->completed == 'TRUE')
                                <p class="line-through ...">{{ $todo->title }}</p>
                            @else
                                <p>{{ $todo->title }}</p>
                            @endif

                        </td>
                        <td scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if ($todo->completed == 'TRUE')
                                Complete
                            @else
                                On Progress
                            @endif

                        </td>
                        <td scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if ($todo->completed == 0)
                                -
                            @else
                                {{ $todo->updated_at }}
                            @endif

                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('todo.edit', $todo->id) }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            <a wire:click.prevent="delete({{ $todo->id }})"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
</div>

{{-- <div>
    <div>
        <table class="border-collapse border border-slate-400 ...">
            <thead>
                <tr>
                    <th class="border border-slate-300 ...">Task List</th>
                    <th class="border border-slate-300 ...">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($todos as $todo)
                    <tr>
                        <td class="border border-slate-300 ...">{{ $todo->title }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                        <td class="border border-slate-300 ...">&nbsp;&nbsp;&nbsp;
                            <a href="">edit</a>
                            <a href="">delete</a>
                            &nbsp;&nbsp;&nbsp;
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table> --}}
{{-- <table class="border-collapse border border-slate-400 ..."">
            <thead>
                <tr>
                    <th></th>
                </tr>
                <tr>
                    <th>Task List</th>
                </tr>
                <tr>

                </tr>
            </thead>
        </table> --}}
{{-- </div>
</div> --}}
