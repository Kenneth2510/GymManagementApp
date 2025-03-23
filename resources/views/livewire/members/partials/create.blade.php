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
                    <flux:input wire:model="phone" label="Phone" placeholder="Phone" />
                </div>
            </flux:field>

            <flux:field>
                <div class="grid grid-cols-2 gap-4">
                    <flux:input type="date" wire:model="bday" max="2999-12-31" label="Birthday" />
                    <flux:input type="file" wire:model="photo" label="Photo"/>
                </div>
            </flux:field>

            <div class="flex">
                <flux:spacer />
                <flux:button variant="primary" wire:click="submit">Save</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
