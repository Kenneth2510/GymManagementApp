<div class="z-[80] p-5">
    <livewire:progress.partials.create />
    <livewire:progress.partials.edit />

    <flux:modal name="delete-progress" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete Progress?</flux:heading>

                <flux:subheading>
                    <p>You're about to delete this progress.</p>
                    <p>This action cannot be reversed.</p>
                </flux:subheading>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button variant="danger" wire:click="destroy()">Delete progress</flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="view-progress" class="w-10/12 md:w-12/12 md:h-11/12 z-30">
        <div class="flex flex-col space-y-8">
            <div>
                <flux:heading size="lg">View Member</flux:heading>
                <flux:subheading>View details for the member.</flux:subheading>
            </div>

            <flux:separator />
            <div class="flex flex-col items-center text-center">
                <flux:avatar circle class="size-32" src="{{ Storage::url($photo) }}" />
                <div class="mt-5">
                    <flux:heading size="xl" class="font-semibold">{{ $fname . " " . $mname . " " . $lname }}</flux:heading>
                    <flux:subheading>{{ $email . " | " . $phone }}</flux:subheading>
                    <flux:subheading>Birthday: {{ $bday }}</flux:subheading>
                    <flux:subheading>User created on {{ $created_at }}</flux:subheading>
                </div>
            </div>

            <flux:separator />
            <div class="flex flex-col space-y-8 items-center">
                <div class="w-full text-center">
                    <flux:heading size="xl">Body Progress</flux:heading>

                        <flux:button icon="pencil-square" class="my-2 hover:!bg-gray-800 hover:!text-white" wire:click="add_progress({{ $memberid }})">Add Progress</flux:button>

                    <div class="relative overflow-x-auto w-full">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-3">Date</th>
                                    <th class="px-6 py-3">Height and Weight</th>
                                    <th class="px-6 py-3">BMI</th>
                                    <th class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($progresses as $progress)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $progress->date_record }}</th>
                                        <td class="px-6 py-4">{{ $progress->height . " m" }} <br> {{ $progress->weight . " kg" }}</td>
                                        <td class="px-6 py-4">{{ $progress->bmi }} <br> {{ $progress->bmi_remarks }}</td>
                                        <td class="px-6 py-4">
                                            <flux:button icon="pencil" size="sm" class="mx-1" wire:click="edit({{$progress->id}})">Edit</flux:button>
                                            <br>
                                            <flux:button icon="trash" size="sm" class="mx-1" variant="danger" wire:click="delete({{$progress->id}})">Delete</flux:button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-4 py-3 text-center" colspan="4">No progress found</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="w-full text-center">
                    <flux:heading size="xl">Subscriptions</flux:heading>
                    <div class="relative overflow-x-auto w-full">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-3">Program</th>
                                    <th class="px-6 py-3">Program Status</th>
                                    <th class="px-6 py-3">Payment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subscriptions as $subscription)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $subscription->program->title }} <br> {{ $subscription->start_date }} <br> {{ $subscription->end_date }}</th>
                                        <td class="px-6 py-4">
                                            @if ($subscription->status === 'pending')
                                                <flux:badge color="yellow">Pending</flux:badge>
                                            @elseif ($subscription->status === 'active')
                                                <flux:badge color="emerald">Active</flux:badge>
                                            @else
                                                <flux:badge color="zinc">Expired</flux:badge>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($subscription->transactions->isNotEmpty() && $subscription->transactions->first()->isPaid === 0)
                                                <flux:badge color="yellow" icon="x-circle">Pending</flux:badge>
                                            @else
                                                <flux:badge icon="check-circle" color="emerald">Active</flux:badge>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-4 py-3 text-center" colspan="4">No subscriptions found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <flux:separator />
            <div class="w-full text-center">
                <flux:heading size="xl">Attendance</flux:heading>
                <div class="relative overflow-x-auto w-full">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Date</th>
                                <th class="px-6 py-3">Period</th>
                                <th class="px-6 py-3">Time In</th>
                                <th class="px-6 py-3">Time Out</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($attendances as $attendance)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $attendance->date }}</th>
                                    <td class="px-6 py-4">{{ $attendance->subscription->program->title }} <br> {{ $attendance->subscription->start_date }} <br> {{ $attendance->subscription->end_date }}</td>
                                    <td class="px-6 py-4">{{ $attendance->timeIn }}</td>
                                    <td class="px-6 py-4">{{ $attendance->timeOut }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-4 py-3 text-center" colspan="4">No Attendances found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </flux:modal>
</div>
