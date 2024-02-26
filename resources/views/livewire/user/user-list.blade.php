<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nama
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Completed
                </th>
                <th scope="col" class="px-6 py-3">
                    On Progress
                </th>
                <th scope="col" class="px-6 py-3">
                    Total Todo
                </th>
                {{-- <th scope="col" class="px-6 py-3">
                    Action
                </th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                @php

                    $isi = $user->todos;
                    $jumlah_berhasil = [];
                    $jumlah_gagal = [];
                    foreach ($isi as $key => $value) {
                        if ($value['completed'] == true) {
                            array_push($jumlah_berhasil, $value['completed']);
                        } else {
                            array_push($jumlah_gagal, $value['completed']);
                        }
                    }
                @endphp
                <tr>
                    <td class="px-6 py-4">
                        {{ $user->name }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $user->email }}
                    </td>

                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ count($jumlah_berhasil) }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ count($jumlah_gagal) }}
                        {{-- {{ withCount($user->todos->completed) }} --}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $user->todos_count }}
                    </th>
                    {{-- <td class="px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                </td> --}}
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
</div>
