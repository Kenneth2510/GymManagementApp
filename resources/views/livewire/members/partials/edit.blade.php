<div>
    <flux:modal name="edit-member" class="md:w-8/12 z-80">
    <div class="space-y-8">
        <div>
            <flux:heading size="lg">Edit Member</flux:heading>
            <flux:subheading>Edit details for the member.</flux:subheading>
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

            <flux:button variant="primary" wire:click="update">Save</flux:button>
        </div>
    </div>
</flux:modal>
</div>
