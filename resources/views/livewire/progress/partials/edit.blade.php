<div class="z-[80]">
    <flux:modal name="edit-progress" class="md:w-8/12 z-30">
        <div class="space-y-8">

            <flux:heading size="lg">Body Progress</flux:heading>
            <flux:subheading>Edit progress details for the member.</flux:subheading>
            <flux:field>
                <div class="grid grid-cols-2 gap-4">
                    <flux:input type="number" wire:model="height" min="0.5" max="3" step="0.01" label="Height in Meters (m)" />
                    <flux:input type="number" wire:model="weight" min="10" max="500" step="0.1" label="Weight in Kilograms (kg)"/>
                </div>
            </flux:field>

            <div class="flex">
                <flux:spacer />
                <flux:button variant="primary" wire:click="update">Save</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
