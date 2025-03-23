<div>
    <flux:modal name="edit-subscription" class="md:w-8/12 z-30">
        <div class="space-y-8">
            <div>
                <flux:heading size="lg">Edit Subscription</flux:heading>
                <flux:subheading>Edit details for the subscription.</flux:subheading>
            </div>

            <flux:field>
                <div x-data="{ open:false }" class="relative">
                    <flux:input label="Select Member" wire:model.live.debounce.300ms="memberSearch" @click="open = true" 
                    placeholder="Search Member..." autocomplete="off" class="border p-2 w-full rounded-lg focus:ring-primary-500 focus:border-primary-500" />
    
                    @if(!empty($memberList))
                        <ul class="absolute border bg-white w-full mt-1 max-h-40 overflow-y-auto z-10">
                            @foreach ($memberList as $member)
                                <li wire:click="selectMember({{ $member->id }})"
                                    @click="open =false"
                                    class="p-2 cursor-pointer">
                                        {{ $member->fname }} {{ $member->mname }} {{ $member->lname }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
    
                    <select wire:model="selectedMember" class="hidden">
                        @if ($selectedMember)
                            <option value="{{ $selectedMember->id }}" selected>{{ $selectedMember->fname }} {{ $selectedMember->mname }} {{ $selectedMember->lname }}</option>
                        @endif
                    </select>
                </div>
            </flux:field>

            <flux:field>
                <flux:select wire:model.live="selectedProgram" label="Select Program">
                    <option value="" selected>Choose Program</option>
                    @foreach ($programList as $program)
                        <option value="{{ $program->id }}">{{ $program->title }}</option>
                    @endforeach
                </flux:select>

                @if($programDescription)
                    <div class="m-2 py-1">
                        <flux:heading size="lg">{{ $programDescription }}</flux:heading>
                        <flux:heading>{{ $numOfDays }} Days</flux:heading>
                        <flux:badge variant="pill" icon="philippine-peso">{{ $programPrice }}</flux:badge>
                    </div>
                @endif
            </flux:field>

            <flux:field>
                <div class="grid grid-cols-2 gap-4">
                    <flux:input type="date" wire:model="start_date" min="{{ now()->toDateString() }}" max="2999-12-31" label="Start Date" />
                    <flux:input type="date" wire:model="end_date" min="{{ now()->toDateString() }}" max="2999-12-31" label="End Date" />
                </div>
            </flux:field>
            


            <div class="flex">
                <flux:spacer />
                <flux:button variant="primary" wire:click="update">Save</flux:button>
            </div>
        </div>
    </flux:modal>
</div>