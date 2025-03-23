<div class="z-[80]">
    <flux:modal name="create-program" class="md:w-8/12 z-30">
        <div class="space-y-8">
            <div>
                <flux:heading size="lg">Create Program</flux:heading>
                <flux:subheading>Add details for the program.</flux:subheading>
            </div>

            <flux:field>
                <flux:input wire:model="title" label="Program Title" placeholder="Program Title" />
            </flux:field>

            <flux:field>
                <flux:textarea wire:model='description' label="Program Description" placeholder="Program Description" />
            </flux:field>

            <flux:field>
                <div class="grid grid-cols-2 gap-4">
                    <flux:input type="number" min="1" wire:model="numOfDays" label="Number of Days"
                    placeholder="Number of Days" />
                    <flux:input icon="philippine-peso" wire:model="price" label="Price" placeholder="100.00" />
                </div>
            </flux:field>


            <div class="flex">
                <flux:spacer />
                <flux:button variant="primary" wire:click="submit">Save</flux:button>
            </div>
        </div>
    </flux:modal>
</div>