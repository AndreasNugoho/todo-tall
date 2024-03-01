<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <h1
            class="font-extrabold leading-none tracking-tight text-center text-gray-900 mb-7 md:text-5xl dark:text-white">
            On Progress</h1>
        <div class="inline-flex">
            <div x-data="{
                datePickerOpen: false,
                datePickerValue: '',
                datePickerFormat: 'M d, Y',
                datePickerMonth: '',
                datePickerYear: '',
                datePickerDay: '',
                datePickerDaysInMonth: [],
                datePickerBlankDaysInMonth: [],
                datePickerMonthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datePickerDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                datePickerDayClicked(day) {
                    let selectedDate = new Date(this.datePickerYear, this.datePickerMonth, day);
                    this.datePickerDay = day;
                    this.datePickerValue = this.datePickerFormatDate(selectedDate);
                    this.datePickerIsSelectedDate(day);
                    this.datePickerOpen = false;
                },
                datePickerPreviousMonth() {
                    if (this.datePickerMonth == 0) {
                        this.datePickerYear--;
                        this.datePickerMonth = 12;
                    }
                    this.datePickerMonth--;
                    this.datePickerCalculateDays();
                },
                datePickerNextMonth() {
                    if (this.datePickerMonth == 11) {
                        this.datePickerMonth = 0;
                        this.datePickerYear++;
                    } else {
                        this.datePickerMonth++;
                    }
                    this.datePickerCalculateDays();
                },
                datePickerIsSelectedDate(day) {
                    const d = new Date(this.datePickerYear, this.datePickerMonth, day);
                    return this.datePickerValue === this.datePickerFormatDate(d) ? true : false;
                },
                datePickerIsToday(day) {
                    const today = new Date();
                    const d = new Date(this.datePickerYear, this.datePickerMonth, day);
                    return today.toDateString() === d.toDateString() ? true : false;
                },
                datePickerCalculateDays() {
                    let daysInMonth = new Date(this.datePickerYear, this.datePickerMonth + 1, 0).getDate();
                    // find where to start calendar day of week
                    let dayOfWeek = new Date(this.datePickerYear, this.datePickerMonth).getDay();
                    let blankdaysArray = [];
                    for (var i = 1; i <= dayOfWeek; i++) {
                        blankdaysArray.push(i);
                    }
                    let daysArray = [];
                    for (var i = 1; i <= daysInMonth; i++) {
                        daysArray.push(i);
                    }
                    this.datePickerBlankDaysInMonth = blankdaysArray;
                    this.datePickerDaysInMonth = daysArray;
                },
                datePickerFormatDate(date) {
                    let formattedDay = this.datePickerDays[date.getDay()];
                    let formattedDate = ('0' + date.getDate()).slice(-2); // appends 0 (zero) in single digit date
                    let formattedMonth = this.datePickerMonthNames[date.getMonth()];
                    let formattedMonthShortName = this.datePickerMonthNames[date.getMonth()].substring(0, 3);
                    let formattedMonthInNumber = ('0' + (parseInt(date.getMonth()) + 1)).slice(-2);
                    let formattedYear = date.getFullYear();
            
                    if (this.datePickerFormat === 'M d, Y') {
                        return `${formattedMonthShortName} ${formattedDate}, ${formattedYear}`;
                    }
                    if (this.datePickerFormat === 'MM-DD-YYYY') {
                        return `${formattedMonthInNumber}-${formattedDate}-${formattedYear}`;
                    }
                    if (this.datePickerFormat === 'DD-MM-YYYY') {
                        return `${formattedDate}-${formattedMonthInNumber}-${formattedYear}`;
                    }
                    if (this.datePickerFormat === 'YYYY-MM-DD') {
                        return `${formattedYear}-${formattedMonthInNumber}-${formattedDate}`;
                    }
                    if (this.datePickerFormat === 'D d M, Y') {
                        return `${formattedDay} ${formattedDate} ${formattedMonthShortName} ${formattedYear}`;
                    }
            
                    return `${formattedMonth} ${formattedDate}, ${formattedYear}`;
                },
            }" x-init="currentDate = new Date();
            if (datePickerValue) {
                currentDate = new Date(Date.parse(datePickerValue));
            }
            datePickerMonth = currentDate.getMonth();
            datePickerYear = currentDate.getFullYear();
            datePickerDay = currentDate.getDay();
            datePickerValue = datePickerFormatDate(currentDate);
            datePickerCalculateDays();" x-model = "datePickerValue" x-cloak>
                <div class="container px-4 py-2 mx-auto">
                    <div class="w-64 mb-5">
                        <label for="datepicker" class="block mb-1 text-sm font-medium text-neutral-500">Filter
                            Date</label>
                        <div class="relative w-[17rem]">
                            <input x-ref="datePickerInput" type="text" @click="datePickerOpen=!datePickerOpen"
                                x-model="datePickerValue" x-on:keydown.escape="datePickerOpen=false"
                                class="flex w-full h-10 px-3 py-2 text-sm bg-white border-2 text-neutral-600 border-neutral-600 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-800 focus:text-neutral-800 focus:outline-none focus:ring-0 disabled:cursor-not-allowed disabled:opacity-50"
                                placeholder="Select date" readonly />
                            <div @click="datePickerOpen=!datePickerOpen; if(datePickerOpen){ $refs.datePickerInput.focus() }"
                                :class="{
                                    'text-neutral-600 hover:text-neutral-800': !
                                        datePickerOpen,
                                    'text-neutral-800': datePickerOpen
                                }"
                                class="absolute top-0 right-0 px-3 py-2 cursor-pointer">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div x-show="datePickerOpen" x-transition @click.away="datePickerOpen = false"
                                class="absolute top-0 left-0 max-w-lg p-4 mt-12 antialiased bg-white border-2 border-neutral-800 shadow w-[17rem] border-neutral-200/70">
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <span x-text="datePickerMonthNames[datePickerMonth]"
                                            class="text-lg font-bold text-gray-800"></span>
                                        <span x-text="datePickerYear"
                                            class="ml-1 text-lg font-normal text-gray-600"></span>
                                    </div>
                                    <div>
                                        <button @click="datePickerPreviousMonth()" type="button"
                                            class="inline-flex p-1 transition duration-100 ease-in-out cursor-pointer focus:outline-none focus:shadow-outline hover:bg-gray-100">
                                            <svg class="inline-flex w-6 h-6 text-gray-400" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 19l-7-7 7-7" />
                                            </svg>
                                        </button>
                                        <button @click="datePickerNextMonth()" type="button"
                                            class="inline-flex p-1 transition duration-100 ease-in-out cursor-pointer focus:outline-none focus:shadow-outline hover:bg-gray-100">
                                            <svg class="inline-flex w-6 h-6 text-gray-400" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="grid grid-cols-7 mb-3">
                                    <template x-for="(day, index) in datePickerDays" :key="index">
                                        <div class="px-0.5">
                                            <div x-text="day" class="text-xs font-medium text-center text-gray-800">
                                            </div>
                                        </div>
                                    </template>
                                </div>
                                <div class="grid grid-cols-7">
                                    <template x-for="blankDay in datePickerBlankDaysInMonth">
                                        <div class="p-1 text-sm text-center border border-transparent"></div>
                                    </template>
                                    <template x-for="(day, dayIndex) in datePickerDaysInMonth" :key="dayIndex">
                                        <div class="px-0.5 mb-1 aspect-square">
                                            <div x-text="day" @click="datePickerDayClicked(day)"
                                                :class="{
                                                    'bg-neutral-200': datePickerIsToday(day) == true,
                                                    'text-gray-600 hover:bg-neutral-200': datePickerIsToday(day) ==
                                                        false &&
                                                        datePickerIsSelectedDate(day) == false,
                                                    'bg-neutral-800 text-white hover:bg-opacity-75': datePickerIsSelectedDate(
                                                        day) == true
                                                }"
                                                class="flex items-center justify-center text-sm leading-none text-center cursor-pointer h-7 w-7"
                                                x-model="datePickerValue"
                                                wire:click="filterDate(day,datePickerMonthNames[datePickerMonth], datePickerYear)">
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="relative top-[40px] left-2">To</p>
            <div x-data="{
                datePickerOpen: false,
                datePickerValue: '',
                datePickerFormat: 'M d, Y',
                datePickerMonth: '',
                datePickerYear: '',
                datePickerDay: '',
                datePickerDaysInMonth: [],
                datePickerBlankDaysInMonth: [],
                datePickerMonthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datePickerDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                datePickerDayClicked(day) {
                    let selectedDate = new Date(this.datePickerYear, this.datePickerMonth, day);
                    this.datePickerDay = day;
                    this.datePickerValue = this.datePickerFormatDate(selectedDate);
                    this.datePickerIsSelectedDate(day);
                    this.datePickerOpen = false;
                },
                datePickerPreviousMonth() {
                    if (this.datePickerMonth == 0) {
                        this.datePickerYear--;
                        this.datePickerMonth = 12;
                    }
                    this.datePickerMonth--;
                    this.datePickerCalculateDays();
                },
                datePickerNextMonth() {
                    if (this.datePickerMonth == 11) {
                        this.datePickerMonth = 0;
                        this.datePickerYear++;
                    } else {
                        this.datePickerMonth++;
                    }
                    this.datePickerCalculateDays();
                },
                datePickerIsSelectedDate(day) {
                    const d = new Date(this.datePickerYear, this.datePickerMonth, day);
                    return this.datePickerValue === this.datePickerFormatDate(d) ? true : false;
                },
                datePickerIsToday(day) {
                    const today = new Date();
                    const d = new Date(this.datePickerYear, this.datePickerMonth, day);
                    return today.toDateString() === d.toDateString() ? true : false;
                },
                datePickerCalculateDays() {
                    let daysInMonth = new Date(this.datePickerYear, this.datePickerMonth + 1, 0).getDate();
                    // find where to start calendar day of week
                    let dayOfWeek = new Date(this.datePickerYear, this.datePickerMonth).getDay();
                    let blankdaysArray = [];
                    for (var i = 1; i <= dayOfWeek; i++) {
                        blankdaysArray.push(i);
                    }
                    let daysArray = [];
                    for (var i = 1; i <= daysInMonth; i++) {
                        daysArray.push(i);
                    }
                    this.datePickerBlankDaysInMonth = blankdaysArray;
                    this.datePickerDaysInMonth = daysArray;
                },
                datePickerFormatDate(date) {
                    let formattedDay = this.datePickerDays[date.getDay()];
                    let formattedDate = ('0' + date.getDate()).slice(-2); // appends 0 (zero) in single digit date
                    let formattedMonth = this.datePickerMonthNames[date.getMonth()];
                    let formattedMonthShortName = this.datePickerMonthNames[date.getMonth()].substring(0, 3);
                    let formattedMonthInNumber = ('0' + (parseInt(date.getMonth()) + 1)).slice(-2);
                    let formattedYear = date.getFullYear();
            
                    if (this.datePickerFormat === 'M d, Y') {
                        return `${formattedMonthShortName} ${formattedDate}, ${formattedYear}`;
                    }
                    if (this.datePickerFormat === 'MM-DD-YYYY') {
                        return `${formattedMonthInNumber}-${formattedDate}-${formattedYear}`;
                    }
                    if (this.datePickerFormat === 'DD-MM-YYYY') {
                        return `${formattedDate}-${formattedMonthInNumber}-${formattedYear}`;
                    }
                    if (this.datePickerFormat === 'YYYY-MM-DD') {
                        return `${formattedYear}-${formattedMonthInNumber}-${formattedDate}`;
                    }
                    if (this.datePickerFormat === 'D d M, Y') {
                        return `${formattedDay} ${formattedDate} ${formattedMonthShortName} ${formattedYear}`;
                    }
            
                    return `${formattedMonth} ${formattedDate}, ${formattedYear}`;
                },
            }" x-init="currentDate = new Date();
            if (datePickerValue) {
                currentDate = new Date(Date.parse(datePickerValue));
            }
            datePickerMonth = currentDate.getMonth();
            datePickerYear = currentDate.getFullYear();
            datePickerDay = currentDate.getDay();
            datePickerValue = datePickerFormatDate(currentDate);
            datePickerCalculateDays();" x-model = "datePickerValue" x-cloak>
                <div class="container px-4 py-2 mx-auto ">
                    <div class="w-64 mb-5">
                        <label for="datepicker" class="block mb-1 text-sm font-medium text-neutral-500">Filter
                            Date</label>
                        <div class="relative w-[17rem]">
                            <input x-ref="datePickerInput" type="text" @click="datePickerOpen=!datePickerOpen"
                                x-model="datePickerValue" x-on:keydown.escape="datePickerOpen=false"
                                class="flex w-full h-10 px-3 py-2 text-sm bg-white border-2 text-neutral-600 border-neutral-600 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-800 focus:text-neutral-800 focus:outline-none focus:ring-0 disabled:cursor-not-allowed disabled:opacity-50"
                                placeholder="Select date" readonly />
                            <div @click="datePickerOpen=!datePickerOpen; if(datePickerOpen){ $refs.datePickerInput.focus() }"
                                :class="{
                                    'text-neutral-600 hover:text-neutral-800': !
                                        datePickerOpen,
                                    'text-neutral-800': datePickerOpen
                                }"
                                class="absolute top-0 right-0 px-3 py-2 cursor-pointer">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div x-show="datePickerOpen" x-transition @click.away="datePickerOpen = false"
                                class="absolute top-0 left-0 max-w-lg p-4 mt-12 antialiased bg-white border-2 border-neutral-800 shadow w-[17rem] border-neutral-200/70">
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <span x-text="datePickerMonthNames[datePickerMonth]"
                                            class="text-lg font-bold text-gray-800"></span>
                                        <span x-text="datePickerYear"
                                            class="ml-1 text-lg font-normal text-gray-600"></span>
                                    </div>
                                    <div>
                                        <button @click="datePickerPreviousMonth()" type="button"
                                            class="inline-flex p-1 transition duration-100 ease-in-out cursor-pointer focus:outline-none focus:shadow-outline hover:bg-gray-100">
                                            <svg class="inline-flex w-6 h-6 text-gray-400" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 19l-7-7 7-7" />
                                            </svg>
                                        </button>
                                        <button @click="datePickerNextMonth()" type="button"
                                            class="inline-flex p-1 transition duration-100 ease-in-out cursor-pointer focus:outline-none focus:shadow-outline hover:bg-gray-100">
                                            <svg class="inline-flex w-6 h-6 text-gray-400" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="grid grid-cols-7 mb-3">
                                    <template x-for="(day, index) in datePickerDays" :key="index">
                                        <div class="px-0.5">
                                            <div x-text="day" class="text-xs font-medium text-center text-gray-800">
                                            </div>
                                        </div>
                                    </template>
                                </div>
                                <div class="grid grid-cols-7">
                                    <template x-for="blankDay in datePickerBlankDaysInMonth">
                                        <div class="p-1 text-sm text-center border border-transparent"></div>
                                    </template>
                                    <template x-for="(day, dayIndex) in datePickerDaysInMonth" :key="dayIndex">
                                        <div class="px-0.5 mb-1 aspect-square">
                                            <div x-text="day" @click="datePickerDayClicked(day)"
                                                :class="{
                                                    'bg-neutral-200': datePickerIsToday(day) == true,
                                                    'text-gray-600 hover:bg-neutral-200': datePickerIsToday(day) ==
                                                        false &&
                                                        datePickerIsSelectedDate(day) == false,
                                                    'bg-neutral-800 text-white hover:bg-opacity-75': datePickerIsSelectedDate(
                                                        day) == true
                                                }"
                                                class="flex items-center justify-center text-sm leading-none text-center cursor-pointer h-7 w-7"
                                                x-model="datePickerValue"
                                                wire:click="filterDateTo(day,datePickerMonthNames[datePickerMonth], datePickerYear)">
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
        <button type="button"
            class="relative inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md top-[34px] bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none"
            wire:click="resetDate()">
            Reset
        </button>




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
                        Due Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
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
                            <input wire:click.prevent='complete({{ $todo->id }})' type="checkbox" id='todo'
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
                            {{-- @if ($todo->completed == 0)
                                -
                            @else
                                {{ $todo->completed_at }}
                            @endif --}}
                            {{ $todo->due_at->format('j - F - Y') }}

                        </td>
                        <td scope="row"
                            class="px-6 py-4 font-medium text-red-500 whitespace-nowrap dark:text-white">
                            {{ $this->overDue($todo->due_at) }}
                            {{-- {{ $todo->due_at->format('j - F - Y') }} --}}

                        </td>
                        <td class="inline-flex px-6 py-4">
                            <div x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false"
                                :class="{ 'z-40': modalOpen }" class="relative w-auto h-auto">
                                <button @click="modalOpen=true"
                                    class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none"
                                    wire:click.prevent='edit({{ $todo }})'>Edit</button>
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
                                </template>

                            </div>

                            {{-- <div x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false"
                                :class="{ 'z-40': modalOpen }" class="relative w-auto h-auto">
                                <a wire:click.prevent="edit({{ $todo }})" @click="modalOpen=true"
                                    class="inline-flex items-center justify-center h-10 text-xl font-medium transition-colors bg-white hover:bg-neutral-100 hover:text-green-500 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">
                                    Edit</a>
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
                                            class="relative w-full py-6 bg-white border shadow-lg px-7 border-neutral-200 sm:max-w-lg sm:rounded-lg font-inconsolata">
                                            <div class="flex items-center justify-between pb-3">
                                                <h3 class="text-lg font-semibold">Update task {{ $todo->title }}</h3>
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
                                            <form wire:submit.prevent="update">
                                                <div class="mb-3">
                                                    <label for="taskid" class="block">Task ID</label>
                                                    <input type="text" id="taskid" disabled
                                                        class="disabled:bg-slate-200 ring-1 ring-slate-400 py-2 px-4 w-[300px]"
                                                        value="{{ $todo->id }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="title" class="block">Task Title</label>
                                                    <input wire:model.defer="title" type="text" id="title"
                                                        class="ring-1 ring-slate-400 py-2 px-4 w-[300px]"
                                                        value="{{ $todo->title }}">
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
                                </template>
                            </div> --}}


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
