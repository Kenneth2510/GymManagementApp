<div>

    <flux:modal.trigger name="create-member">
        <flux:button icon="pencil-square">Create Member</flux:button>
    </flux:modal.trigger>


    <livewire:members.partials.create />
    <livewire:members.partials.edit />
    <livewire:progress.progress />


    <flux:modal name="delete-member" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete Member?</flux:heading>

                <flux:subheading>
                    <p>You're about to delete this member.</p>
                    <p>This action cannot be reversed.</p>
                </flux:subheading>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button variant="danger" wire:click="destroy()">Delete member</flux:button>
            </div>
        </div>
    </flux:modal>

    <section class="mt-1">
        <div class="mx-auto max-w-screen-3xl px-4 lg:px-12">
            <!-- Start coding here -->
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
                                    'name' => 'email',
                                    'displayName' => 'CONTACT'
                                ])
                                @include('livewire.includes.table-sortable-th', [
                                    'name' => 'bday',
                                    'displayName' => 'BIRTHDAY'
                                ])
                                @include('livewire.includes.table-sortable-th', [
                                    'name' => 'created_at',
                                    'displayName' => 'CREATED AT'
                                ])
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($members as $member)
                                <tr wire:key="{{ $member->id }}" class="border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $member->fname }} {{ $member->mname }} {{ $member->lname }}
                                    </th>
                                    <td class="px-4 py-3">{{ $member->email }} <br> {{ $member->phone }}</td>
                                    <td class="px-4 py-3">{{ $member->bday }}</td>
                                    <td class="px-4 py-3">Created on: {{ $member->created_at }} <br> Last Update on: {{ $member->updated_at }}</td>
                                    <td class="px-4 py-3 flex items-center justify-end">
                                        <flux:button icon="chart-bar" size="sm" class="mx-1" wire:click="view_progress({{ $member->id }})">View Progress</flux:button>
                                        <flux:button icon="pencil" size="sm" class="mx-1 bg-amber-300" wire:click="edit({{$member->id}})">Edit</flux:button>
                                        <flux:button icon="trash" size="sm" class="mx-1" variant="danger" wire:click="delete({{$member->id}})">Delete
                                        </flux:button>    
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
                    {{ $members->links() }}
                </div>
            </div>
        </div>
    </section>


</div>