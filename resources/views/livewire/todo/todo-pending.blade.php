<div>
    {{-- <ul class="bg-white shadow overflow-hidden sm:rounded-md max-w-lg mx-auto py-5 ">
        <h1
            class="font-extrabold leading-none tracking-tight text-center text-gray-900 mb-5 md:text-5xl dark:text-white ">
            On Progress</h1>
        <div>
            <div class="flex">
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
                        <div class="w-64">
                            <label for="datepicker" class="block mb-1 text-sm font-medium text-neutral-500">Filter
                                Date</label>
                            <div class="relative w-[17rem]">
                                <input x-ref="datePickerInput" type="text" @click="datePickerOpen=!datePickerOpen"
                                    x-model="datePickerValue" x-on:keydown.escape="datePickerOpen=false"
                                    class="flex w-[150px] h-10 px-3 py-2 text-sm bg-white border-2 text-neutral-600 border-neutral-600 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-800 focus:text-neutral-800 focus:outline-none focus:ring-0 disabled:cursor-not-allowed disabled:opacity-50"
                                    placeholder="Select date" readonly />
                                <div @click="datePickerOpen=!datePickerOpen; if(datePickerOpen){ $refs.datePickerInput.focus() }"
                                    :class="{
                                        'text-neutral-600 hover:text-neutral-800': !
                                            datePickerOpen,
                                        'text-neutral-800': datePickerOpen
                                    }"
                                    class="absolute top-0 right-20 px-3 py-2 cursor-pointer">
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
                <p class="relative top-[40px] right-20">To</p>
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
                        <div class="w-64">
                            <label for="datepicker" class="block mb-1 text-sm font-medium text-neutral-500 relative right-20">Filter
                                Date</label>
                            <div class="relative w-[17rem] right-20">
                                <input x-ref="datePickerInput" type="text" @click="datePickerOpen=!datePickerOpen"
                                    x-model="datePickerValue" x-on:keydown.escape="datePickerOpen=false"
                                    class="flex w-[150px]  h-10 px-3 py-2 text-sm bg-white border-2 text-neutral-600 border-neutral-600 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-800 focus:text-neutral-800 focus:outline-none focus:ring-0 disabled:cursor-not-allowed disabled:opacity-50"
                                    placeholder="Select date" readonly />
                                <div @click="datePickerOpen=!datePickerOpen; if(datePickerOpen){ $refs.datePickerInput.focus() }"
                                    :class="{
                                        'text-neutral-600 hover:text-neutral-800': !
                                            datePickerOpen,
                                        'text-neutral-800': datePickerOpen
                                    }"
                                    class="absolute top-0 right-0 px-3 py-2 cursor-pointer">
                                    <svg class="w-6 h-6 relative right-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div x-show="datePickerOpen" x-transition @click.away="datePickerOpen = false"
                                    class="absolute top-0 left-0 max-w-lg p-4 mt-12 antialiased bg-white border-2 border-neutral-800 shadow w-[17rem] border-neutral-200/70 z-50">
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
        </div>
        <div class="flex mb-6">
            <button type="button"
            class="w-96 mx-4 items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md top-[34px] bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none"
            wire:click="resetDate()">
            Reset
            </button>
        </div>

        @foreach ($todos as $todo)
        <li class="border-t border-gray-200">
            <div class="px-4 py-5 sm:px-6 ">
                <div class="flex items-center justify-between gap-3">
                    <div class="flex items-center justify-between gap-3">
                        <input wire:click.prevent='complete({{ $todo->id }})' type="checkbox" id='todo'
                                @if ($todo->completed) checked @else @endif>
                        <h3 class="text-lg leading-6 font-medium text-gray-900 ">{{$todo->title }}</h3>
                    </div>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        {{ $this->overDue($todo->due_at) }}
                    </p>
                </div>
                <div class="mt-4 flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-500">Due Date: <span class="text-yellow-600">
                        {{ $todo->due_at->format('j - F - Y') }}
                    </span></p>
                    <div class="flex gap-1">
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
                                </template>
                            </div>

                    </div>
        </li>
        @endforeach
    </ul> --}}
    <div class="mx-auto container py-20 px-6">
        <h1
            class="font-extrabold leading-none tracking-tight text-center text-gray-900 mb-5 md:text-5xl dark:text-white ">
            On Progress</h1>

        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">



            @foreach ($todos as $todo)
                <div class="rounded">
                    <a href="" wire:click.prevent='complete({{ $todo->id }})'>

                        <div
                            class="w-full h-44 flex flex-col justify-between dark:bg-gray-800 bg-white dark:border-gray-700 rounded-lg border border-gray-400 mb-6 py-5 px-4">
                            <div>
                                <h3 class="text-gray-800 dark:text-gray-100 font-bold mb-3 text-[20px]">
                                    {{ $todo->title }}
                                </h3>
                            </div>
                            <div>
                                <div class="mb-3 flex items-center">
                                    <div class="border border-gray-300 dark:border-gray-700 rounded-full px-3 py-1 dark:text-red-400 text-red-600 text-xs flex items-center"
                                        aria-label="due on" role="contentinfo">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-alarm" width="16" height="16"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z"></path>
                                            <circle cx="12" cy="13" r="7"></circle>
                                            <polyline points="12 10 12 13 14 13"></polyline>
                                            <line x1="7" y1="4" x2="4.25" y2="6"></line>
                                            <line x1="17" y1="4" x2="19.75" y2="6"></line>
                                        </svg>
                                        <p class="ml-2 dark:text-gray-400 "> {{ $this->overDue($todo->due_at) }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between text-gray-800 dark:text-gray-100">
                                    <p class="text-sm">{{ $todo->due_at->format('F j, Y') }}</p>
                    </a>

                    <div class="flex gap-2">
                        <div x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false"
                            :class="{ 'z-40': modalOpen }" class="relative w-auto h-auto">
                            <button @click="modalOpen=true"
                                class="w-8 h-8 rounded-full bg-gray-800 dark:bg-gray-100 dark:text-gray-800 text-white flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-black"
                                aria-label="edit note" role="button" wire:click.prevent='edit({{ $todo }})'>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil"
                                    width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"></path>
                                    <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4">
                                    </path>
                                    <line x1="13.5" y1="6.5" x2="17.5" y2="10.5">
                                    </line>
                                </svg>

                            </button>
                            <template x-teleport="body">
                                <div x-show="modalOpen"
                                    class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen"
                                    x-cloak>
                                    <div x-show="modalOpen" x-transition:enter="ease-out duration-300"
                                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                        x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100"
                                        x-transition:leave-end="opacity-0" @click="modalOpen=false"
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
                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
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
                        <div x-data="{ modalDelete: false }" @keydown.escape.window="modalDelete = false"
                            :class="{ 'z-40': modalDelete }" class="relative w-auto h-auto">
                            <button @click="modalDelete=true"
                                class="w-8 h-8 rounded-full bg-gray-800 dark:bg-gray-100 dark:text-gray-800 text-white flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-black"
                                aria-label="edit note" role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 7l16 0" />
                                    <path d="M10 11l0 6" />
                                    <path d="M14 11l0 6" />
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                </svg>
                            </button>
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
                                            <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-2">
                                                <button @click="modalDelete=false" type="button"
                                                    class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors border rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-100 focus:ring-offset-2">Cancel</button>
                                                <button @click="modalDelete=false"
                                                    wire:click="delete({{ $todo->id }})"
                                                    class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2 bg-neutral-950 hover:bg-neutral-900">Delete</button>

                                            </div>

                                        </div>
                                    </div>
                            </template>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>


{{-- <div class="rounded">
                    <div
                        class="w-full h-64 flex flex-col justify-between dark:bg-gray-800 bg-white dark:border-gray-700 rounded-lg border border-gray-400 mb-6 py-5 px-4">
                        <div>
                            <h3 class="text-gray-800 dark:text-gray-100 leading-7 font-semibold w-11/12">What does
                                success as a UX designer look like and how to get there systematically</h3>
                        </div>
                        <div>
                            <div class="mb-3 flex items-center">
                                <div class="border border-gray-300 dark:border-gray-700 rounded-full px-3 py-1 dark:text-gray-400 text-gray-600 text-xs flex items-center"
                                    aria-label="due on" role="contentinfo">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alarm"
                                        width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <circle cx="12" cy="13" r="7"></circle>
                                        <polyline points="12 10 12 13 14 13"></polyline>
                                        <line x1="7" y1="4" x2="4.25" y2="6"></line>
                                        <line x1="17" y1="4" x2="19.75" y2="6"></line>
                                    </svg>
                                    <p class="ml-2 dark:text-gray-400">7 Sept, 23:00</p>
                                </div>
                                <button
                                    class="p-1 bg-gray-800 dark:bg-gray-100 rounded-full ml-2 text-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-black"
                                    aria-label="save in starred items" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-star"
                                        width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <path
                                            d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            <div class="flex items-center justify-between text-gray-800">
                                <p class="dark:text-gray-100 text-sm">March 28, 2020</p>
                                <button
                                    class="w-8 h-8 rounded-full dark:bg-gray-100 dark:text-gray-800 bg-gray-800 text-white flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-black"
                                    aria-label="edit note" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-pencil" width="20" height="20"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                                        <line x1="13.5" y1="6.5" x2="17.5" y2="10.5"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div> --}}
{{-- <div class="rounded">
                    <div
                        class="w-full h-64 flex flex-col justify-between items-start dark:bg-gray-800 bg-white dark:border-gray-700 rounded-lg border border-gray-400 mb-6 py-5 px-4">
                        <div>
                            <h4 class="text-gray-800 dark:text-gray-100 font-bold mb-3">13 things to work on</h4>
                            <p class="text-gray-800 dark:text-gray-100 text-sm">Probabo, inquit, sic agam, ut labore et
                                voluptatem sequi nesciunt, neque porro quisquam est, quid malum, sensu iudicari</p>
                        </div>
                        <div class="w-full flex flex-col items-start">
                            <div aria-label="time" role="contentinfo"
                                class="mb-3 border border-gray-800 rounded-full px-3 py-1 text-gray-800 dark:text-gray-400 dark:border-gray-700 text-xs flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alarm"
                                    width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"></path>
                                    <circle cx="12" cy="13" r="7"></circle>
                                    <polyline points="12 10 12 13 14 13"></polyline>
                                    <line x1="7" y1="4" x2="4.25" y2="6"></line>
                                    <line x1="17" y1="4" x2="19.75" y2="6"></line>
                                </svg>
                                <p class="ml-2">7 Sept, 23:00</p>
                            </div>
                            <div class="flex items-center justify-between text-gray-800 dark:text-gray-100 w-full">
                                <p class="text-sm">March 28, 2020</p>
                                <button
                                    class="w-8 h-8 rounded-full bg-gray-800 dark:text-gray-800 dark:bg-gray-100 text-white flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-black"
                                    aria-label="edit note" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil"
                                        width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                                        <line x1="13.5" y1="6.5" x2="17.5" y2="10.5"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                </div> --}}
{{-- <div class="rounded">
                    <div
                        class="w-full h-64 flex flex-col justify-between dark:bg-gray-800 bg-white dark:border-gray-700 rounded-lg border border-gray-400 mb-6 py-5 px-4">
                        <div>
                            <h3 class="text-gray-800 dark:text-gray-100 leading-7 font-semibold w-11/12">What does
                                success as a UX designer look like and how to get there systematically</h3>
                        </div>
                        <div>
                            <div class="mb-3 flex items-center">
                                <button
                                    class="p-1 bg-gray-800 dark:bg-gray-100 rounded-full text-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-black"
                                    aria-label="save in starred messages" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-star"
                                        width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <path
                                            d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            <div class="flex items-center justify-between text-gray-800 dark:text-gray-100">
                                <p class="text-sm">March 28, 2020</p>
                                <button
                                    class="w-8 h-8 rounded-full bg-gray-800 text-white dark:bg-gray-100 dark:text-gray-800 flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-black"
                                    aria-label="edit note" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-pencil" width="20" height="20"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                                        <line x1="13.5" y1="6.5" x2="17.5" y2="10.5"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div
                        class="w-full h-64 flex flex-col justify-between dark:bg-gray-800 bg-white dark:border-gray-700 rounded-lg border border-gray-400 mb-6 py-5 px-4">
                        <div>
                            <h3 class="text-gray-800 dark:text-gray-100 leading-7 font-semibold w-11/12">What does
                                success as a UX designer look like and how to get there systematically</h3>
                        </div>
                        <div>
                            <div class="mb-3 flex items-center flex-no-wrap">
                                <div class="w-6 h-6 bg-cover bg-center rounded-md">
                                    <img src="https://tuk-cdn.s3.amazonaws.com/assets/components/avatars/a_4_0.png"
                                        alt="read by Alia"
                                        class="h-full w-full overflow-hidden object-cover rounded-full border-2 border-white dark:border-gray-700 shadow" />
                                </div>
                                <div class="w-6 h-6 bg-cover rounded-md -ml-2">
                                    <img src="https://tuk-cdn.s3.amazonaws.com/assets/components/avatars/a_4_1.png"
                                        alt="read by jason"
                                        class="h-full w-full overflow-hidden object-cover rounded-full border-2 border-white dark:border-gray-700 shadow" />
                                </div>
                                <div class="w-6 h-6 bg-cover rounded-md bg-center -ml-2">
                                    <img src="https://tuk-cdn.s3.amazonaws.com/assets/components/avatars/a_4_2.png"
                                        alt="read by Kane"
                                        class="h-full w-full overflow-hidden object-cover rounded-full border-2 border-white dark:border-gray-700 shadow" />
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-gray-800 dark:text-gray-100">
                                <p class="text-sm">March 28, 2020</p>
                                <button
                                    class="w-8 h-8 rounded-full bg-gray-800 text-white dark:bg-gray-100 dark:text-gray-800 flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-black"
                                    aria-label="edit note" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-pencil" width="20" height="20"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                                        <line x1="13.5" y1="6.5" x2="17.5" y2="10.5"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div
                        class="w-full h-64 flex flex-col justify-between bg-red-300 rounded-lg border border-red-300 mb-6 py-5 px-4">
                        <div>
                            <h3 class="text-gray-800 leading-7 font-semibold w-11/12">What does success as a UX
                                designer look like and how to get there systematically</h3>
                        </div>
                        <div>
                            <div class="flex items-center justify-between text-gray-800">
                                <p class="text-sm">March 28, 2020</p>
                                <button
                                    class="w-8 h-8 rounded-full bg-gray-800 text-white flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2 ring-offset-red-300 focus:ring-black"
                                    aria-label="edit note" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-pencil" width="20" height="20"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                                        <line x1="13.5" y1="6.5" x2="17.5" y2="10.5"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div> --}}
@endforeach
</div>
</div>
</div>
