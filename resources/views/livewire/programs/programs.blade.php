<div>

    <flux:modal.trigger name="create-program">
        <flux:button>Create program</flux:button>
    </flux:modal.trigger>


    <livewire:programs.partials.create />
    <livewire:programs.partials.edit />


    <flux:modal name="delete-program" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete program?</flux:heading>

                <flux:subheading>
                    <p>You're about to delete this program.</p>
                    <p>This action cannot be reversed.</p>
                </flux:subheading>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="danger" wire:click="destroy()">Delete program</flux:button>
            </div>
        </div>
    </flux:modal>

    <section class="mt-10">
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
                    {{-- <div class="flex space-x-3">
                        <div class="flex space-x-3 items-center">
                            <label class="w-40 text-sm font-medium text-gray-900">program Type :</label>
                            <select wire:model.live="admin"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="">All</option>
                                <option value="0">program</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                    </div> --}}
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                @include('livewire.includes.table-sortable-th', [
                                    'name' => 'title',
                                    'displayName' => 'TITLE'
                                ])
                                @include('livewire.includes.table-sortable-th', [
                                    'name' => 'description',
                                    'displayName' => 'DESCRIPTION'
                                ])
                                @include('livewire.includes.table-sortable-th', [
                                    'name' => 'numOfDays',
                                    'displayName' => 'DAYS COVERED'
                                ])
                                @include('livewire.includes.table-sortable-th', [
                                    'name' => 'price',
                                    'displayName' => 'PRICE'
                                ])
                                @include('livewire.includes.table-sortable-th', [
                                    'name' => 'price',
                                    'displayName' => 'PRICE'
                                ])
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($programs as $program)
                                <tr wire:key="{{ $program->id }}" class="border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $program->title }}
                                    </th>
                                    <td class="px-4 py-3">{{ $program->description }}</td>
                                    <td class="px-4 py-3">{{ $program->numOfDays }}</td>
                                    <td class="px-4 py-3">{{ $program->price }}</td>
                                    <td class="px-4 py-3">Created on: {{ $program->created_at }} <br> Last Update on: {{ $program->updated_at }}</td>
                                    <td class="px-4 py-3 flex items-center justify-end">
                                        <flux:button size="sm" class="mx-1" wire:click="edit({{$program->id}})">Edit</flux:button>
                                        <flux:button size="sm" class="mx-1" variant="danger" wire:click="delete({{$program->id}})">Delete
                                        </flux:button>    
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-4 py-3 text-center" colspan="4">No programs found</td>
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
                    {{ $programs->links() }}
                </div>
            </div>
        </div>
    </section>


</div>