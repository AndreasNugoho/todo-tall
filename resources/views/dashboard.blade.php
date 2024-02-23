<x-app-layout>
    @php
        $id = Auth::user()->id;
        $profileData = App\Models\User::find($id);
    @endphp

    @livewire('welcome.header')

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white ">
                {{-- <div class="p-6 text-gray-900">
                    {{ __('Hello,') }}{{ $profileData->name }}
                </div> --}}
                <div
                    class="container max-w-sm py-32 mx-auto mt-px text-left sm:max-w-md md:max-w-lg sm:px-4 md:max-w-none md:text-center">
                    <h1
                        class="text-3xl font-bold leading-10 tracking-tight text-left text-gray-900 md:text-center sm:text-4xl md:text-7xl lg:text-8xl">
                        Hello, {{ $profileData->name }}</h1>
                    <div
                        class="flex flex-col items-center justify-center mt-8 space-y-4 text-center sm:flex-row sm:space-y-0 sm:space-x-4">

                        @if ($profileData->role == 'admin')
                            <span class="relative inline-flex w-full md:w-auto">
                                <a href=""
                                    class="inline-flex items-center justify-center w-full px-8 py-4 text-base font-medium leading-6 text-white bg-gray-900 border border-transparent rounded-full xl:px-10 md:w-auto hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800">
                                    Create Todo
                                </a>
                            </span>
                            <span class="relative inline-flex w-full md:w-auto">
                                <a href="{{ route('dashboard') }}"
                                    class="inline-flex items-center justify-center w-full px-8 py-4 text-base font-medium leading-6 text-gray-900 bg-gray-100 border border-transparent rounded-full xl:px-10 md:w-auto hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200">
                                    Users</a>
                            </span>
                        @else
                            <span class="relative inline-flex w-full md:w-auto">
                                <a href="#_"
                                    class="inline-flex items-center justify-center w-full px-8 py-4 text-base font-medium leading-6 text-white bg-gray-900 border border-transparent rounded-full xl:px-10 md:w-auto hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800">
                                    Create Todo
                                </a>
                            </span>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
