<div class="z-[80]">
    <flux:modal name="edit-program" class="md:w-8/12 z-30">
        <div class="space-y-8">
            <div>
                <flux:heading size="lg">Edit Program</flux:heading>
                <flux:subheading>Edit details for the program.</flux:subheading>
            </div>

            <flux:field>
                <flux:input wire:model="title" label="Program Title" placeholder="Program Title" />
            </flux:field>

            <flux:field>
                <flux:textarea wire:model='description' label="Program Description" placeholder="Program Description" />
            </flux:field>

            <flux:field>
                <flux:input type="number" min="1" wire:model="numOfDays" label="Number of Days"
                    placeholder="Number of Days" />
            </flux:field>

            <flux:field>
                <flux:input.group label="Price">
                    <flux:input.group.prefix>PHP</flux:input.group.prefix>
                    <flux:input wire:model="price" placeholder="100.00" />
                </flux:input.group>
            </flux:field>


            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="update">Save</flux:button>
            </div>
        </div>
    </flux:modal>
</div>