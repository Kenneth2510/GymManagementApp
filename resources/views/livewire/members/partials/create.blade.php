<div class="z-[80]">
    <flux:modal name="create-member" class="md:w-8/12 z-30">
        <div class="space-y-8">
            <div>
                <flux:heading size="lg">Create Member</flux:heading>
                <flux:subheading>Add details for the member.</flux:subheading>
            </div>

            <flux:field>
                <flux:input wire:model="fname" label="First Name" placeholder="First Name" />
                <flux:input wire:model="mname" label="Middle Name" placeholder="Middle Name" />
                <flux:input wire:model="lname" label="Last Name" placeholder="Last Name" />
            </flux:field>

            <flux:field>
                <div class="grid grid-cols-2 gap-4">
                    <flux:input wire:model="email" label="Email" placeholder="Email" />
                    <flux:input wire:model="phone" maxlength="12" label="Phone" placeholder="Phone" />
                </div>
            </flux:field>

            <flux:field>
                <div class="grid grid-cols-2 gap-4">
                    <flux:input type="date" wire:model="bday" max="2999-12-31" label="Birthday" />
                    <flux:input type="file" wire:model="photo" label="Photo"/>
                </div>
            </flux:field>

            <flux:separator />
            <flux:heading size="lg">Body Progress</flux:heading>
            <flux:subheading>Add progress details for the member.</flux:subheading>
            <flux:field>
                <div class="grid grid-cols-2 gap-4">
                    <flux:input type="number" wire:model="height" min="0.5" max="3" step="0.01" label="Height in Meters (m)" />
                    <flux:input type="number" wire:model="weight" min="10" max="500" step="0.1" label="Weight in Kilograms (kg)"/>
                </div>
            </flux:field>

            <div class="flex">
                <flux:spacer />
                <flux:button variant="primary" wire:click="submit">Save</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
