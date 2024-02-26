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
                                {{ $todo->completed_at }}
                            @endif

                        </td>
                        <td class="inline-flex px-6 py-4">
                            <div x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false"
                                :class="{ 'z-40': modalOpen, 'z-40': modalDelete }" class="relative w-auto h-auto">
                                <button @click="modalOpen=true"
                                    class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none"
                                    wire:click.prevent='edit({{ $todo }})'>Edit</button>
                                {{-- <button @click="modalDelete=true"
                                    class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none"
                                    wire:click.prevent='editDelete({{ $todo }})' id='delete'>Delete</button> --}}
                                <template x-teleport="body">
                                    <div x-show="modalOpen"
                                        class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen"
                                        x-cloak>
                                        <div x-show="modalOpen" x-transition:enter="ease-out duration-300"
                                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                            x-transition:leave="ease-in duration-300"
                                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                            @click="modalOpen=false"
                                            class="absolute inset-0 w-full h-full bg-white backdrop-blur-sm bg-opacity-70">
                                        </div>
                                        <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen"
                                            x-transition:enter="ease-out duration-300"
                                            x-transition:enter-start="opacity-0 -translate-y-2 sm:scale-95"
                                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                            x-transition:leave="ease-in duration-200"
                                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                            x-transition:leave-end="opacity-0 -translate-y-2 sm:scale-95"
                                            class="relative w-full py-6 bg-white border shadow-lg px-7 border-neutral-200 sm:max-w-lg sm:rounded-lg">
                                            <div class="flex items-center justify-between pb-3">
                                                <h3 class="text-lg font-semibold">Edit Task</h3>
                                                <button @click="modalOpen=false"
                                                    class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="relative w-auto pb-8">
                                                <form wire:submit.prevent='update'>
                                                    <div>

                                                        <input type="text" id="title"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            wire:model='title' value="{{ $todo->title }}" required />
                                                        <br>
                                                    </div>
                                                    <div
                                                        class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-2">
                                                        <button @click="modalOpen=false" type="button"
                                                            class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors border rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-100 focus:ring-offset-2">Cancel</button>
                                                        <button @click="modalOpen=false" type="submit"
                                                            class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2 bg-neutral-950 hover:bg-neutral-900">Update</button>

                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                        {{-- Batas --}}
                                </template>

                            </div>
                            <div x-data="{ modalDelete: false }" @keydown.escape.window="modalDelete = false"
                                :class="{ 'z-40': modalDelete }" class="relative w-auto h-auto">
                                <button @click="modalDelete=true"
                                    class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">Delete</button>
                                <template x-teleport="body">
                                    <div x-show="modalDelete"
                                        class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen"
                                        x-cloak>
                                        <div x-show="modalDelete" x-transition:enter="ease-out duration-300"
                                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                            x-transition:leave="ease-in duration-300"
                                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                            @click="modalDelete=false"
                                            class="absolute inset-0 w-full h-full bg-white backdrop-blur-sm bg-opacity-70">
                                        </div>
                                        <div x-show="modalDelete" x-trap.inert.noscroll="modalDelete"
                                            x-transition:enter="ease-out duration-300"
                                            x-transition:enter-start="opacity-0 -translate-y-2 sm:scale-95"
                                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                            x-transition:leave="ease-in duration-200"
                                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                            x-transition:leave-end="opacity-0 -translate-y-2 sm:scale-95"
                                            class="relative w-full py-6 bg-white border shadow-lg px-7 border-neutral-200 sm:max-w-lg sm:rounded-lg">
                                            <div class="flex items-center justify-between pb-3">
                                                <h3 class="text-lg font-semibold">Delete Task</h3>
                                                <button @click="modalDelete=false"
                                                    class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="relative w-auto pb-8">
                                                <p>Yakin delete?</p>
                                                <div
                                                    class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-2">
                                                    <button @click="modalDelete=false" type="button"
                                                        class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors border rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-100 focus:ring-offset-2">Cancel</button>
                                                    <button @click="modalDelete=false"
                                                        wire:click="delete({{ $todo->id }})"
                                                        class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2 bg-neutral-950 hover:bg-neutral-900">Delete</button>

                                                </div>

                                            </div>
                                        </div>
                                        {{-- Batas --}}
                                </template>
                            </div>
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
