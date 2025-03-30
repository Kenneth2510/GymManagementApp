<div>

    <section class="mt-10">
        <div class="mx-auto max-w-screen-3xl px-4 lg:px-12">
            <!-- Start coding here -->
            <flux:heading size="xl">Attendance for Today - {{ \Carbon\Carbon::today()->toFormattedDateString() }}</flux:heading>

            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex items-center justify-between d p-4">
                    <div class="flex">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input wire:model.live.debounce.300ms="search" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                placeholder="Search" required="">
                        </div>
                    </div>
 
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                @include('livewire.includes.table-sortable-th', [
                                    'name' => 'fname',
                                    'displayName' => 'NAME'
                                ])
                                @include('livewire.includes.table-sortable-th', [
                                    'name' => 'title',
                                    'displayName' => 'SUBSCRIPTION'
                                ])
                                @include('livewire.includes.table-sortable-th', [
                                    'name' => 'start_date',
                                    'displayName' => 'PERIOD'
                                ])
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($attendees as $attendee)
                                <tr wire:key="{{ $attendee->id }}" class="border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $attendee->member->fname }} {{ $attendee->member->mname }} {{ $attendee->member->lname }}
                                    </th>
                                    <td class="px-4 py-3">{{ $attendee->program->title }}</td>
                                    <td class="px-4 py-3">Start Date: {{ $attendee->start_date }} <br> End Date: {{ $attendee->end_date }}</td>
                                    <td class="px-4 py-3 flex items-center justify-end">
                                        @if (!$attendee->attendance)
                                            <flux:button class="!bg-blue-400 hover:!bg-blue-600" wire:click="timeIn({{ $attendee->id }})" class="bg-blue-500 text-white px-4 py-2 rounded">
                                                Time In
                                            </flux:button>
                                        @elseif ($attendee->attendance && is_null($attendee->attendance->timeOut))
                                            <flux:button class="!bg-red-400 hover:!bg-red-600" wire:click="timeOut({{ $attendee->id }})" class="bg-red-500 text-white px-4 py-2 rounded">
                                                Time Out
                                            </flux:button>
                                        @else
                                            <flux:button class="bg-gray-500 text-white px-4 py-2 rounded cursor-not-allowed" disabled>
                                                Completed
                                            </flux:button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-4 py-3 text-center" colspan="4">No members found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="py-4 px-3">
                    <div class="flex ">
                        <div class="flex space-x-4 items-center mb-3">
                            <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                            <select wire:model.live='perPage'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="5">5</option>
                                <option value="7">7</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    {{ $attendees->links() }}
                </div>
            </div>
        </div>
    </section>

    {{-- attendance log --}}

    <section class="mt-10">
        <div class="mx-auto max-w-screen-3xl px-4 lg:px-12">
            <!-- Start coding here -->
            <flux:heading size="xl">Attendance Logs</flux:heading>

            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex items-center justify-between d p-4">
                    <div class="flex">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input wire:model.live.debounce.300ms="logSearch" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                placeholder="Search" required="">
                        </div>
                    </div>
 
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3">Name</th>
                                <th scope="col" class="px-4 py-3">Subscription</th>
                                <th scope="col" class="px-4 py-3">Period</th>
                                <th scope="col" class="px-4 py-3">Time In</th>
                                <th scope="col" class="px-4 py-3">Time Out</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($attendanceLogs as $log)
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $log->subscription->member->fname }} {{ $log->subscription->member->mname }} {{ $log->subscription->member->lname }}
                            </th>
                            <td class="px-4 py-3">{{ $log->subscription->program->title }}</td>
                            <td class="px-4 py-3">Start Date: {{ $log->subscription->start_date }} <br> End Date: {{ $log->subscription->end_date }}</td>
                            <td class="px-4 py-3">{{ $log->timeIn }}</td>
                            <td class="px-4 py-3">{{ $log->timeOut ?? '-' }}</td>
                            @empty
                                <tr>
                                    <td class="px-4 py-3 text-center" colspan="4">No logs found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="py-4 px-3">
                    <div class="flex ">
                        <div class="flex space-x-4 items-center mb-3">
                            <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                            <select wire:model.live='logPerPage'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="5">5</option>
                                <option value="7">7</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    {{ $attendanceLogs->links() }}
                </div>
            </div>
        </div>
    </section>

</div>