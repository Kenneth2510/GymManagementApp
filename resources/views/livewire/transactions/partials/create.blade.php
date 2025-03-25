<div>
    <flux:modal name="create-transaction" class="md:w-8/12 z-30">
        <div class="space-y-8">
            <div>
                <flux:heading size="lg">Enter New Transaction</flux:heading>
                <flux:subheading>Add details for the transaction.</flux:subheading>
            </div>

            <flux:field>
                <flux:heading>Transaction Details</flux:heading>

                @if ($subscription && $subscription->transactions->isNotEmpty())
                    <flux:subheading>Reference ID: {{ $subscription->transactions->first()->transaction_reference }}
                    </flux:subheading>
                @else
                    <flux:subheading>No transaction found.</flux:subheading>
                @endif
            </flux:field>

            <flux:spacer />

            <flux:field>
                <flux:heading>Subscription Details</flux:heading>

                @if ($subscription)
                    <flux:heading>Member Name</flux:heading>
                    <flux:text>{{ $subscription->member->fname }} {{ $subscription->member->mname }}
                        {{ $subscription->member->lname }}</flux:text>

                    <flux:heading>Program</flux:heading>
                    <flux:text>{{ $subscription->program->title }}</flux:text>

                    <flux:heading>Status: {{ $subscription->status }}</flux:heading>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <flux:heading>Start Date</flux:heading>
                            <flux:text>{{ $subscription->start_date }}</flux:text>
                        </div>
                        <div>
                            <flux:heading>End Date</flux:heading>
                            <flux:text>{{ $subscription->end_date }}</flux:text>
                        </div>
                    </div>
                @else
                    <flux:heading>No subscription found.</flux:heading>
                @endif
            </flux:field>

            <flux:separator />

            @if ($subscription && $subscription->transactions->isNotEmpty())
                <flux:field class="justify-between">
                    <flux:heading>Total Amount:</flux:heading>
                    <flux:heading>P{{ $subscription->transactions->first()->amount }}</flux:heading>
                </flux:field>

                <flux:separator />

                <div class="flex justify-between">
                    <flux:heading>Payment Status:
                        @if ($subscription->transactions->first()->isPaid === 0)
                            <flux:badge variant="solid" color="red">Not Yet Paid</flux:badge>
                        @else
                            <flux:badge variant="solid" color="green">Paid</flux:badge>
                        @endif
                    </flux:heading>

                    
                    @if ($subscription->transactions->first()->isPaid === 0)
                        <flux:button variant="primary" wire:click="markPaid">Mark as Paid</flux:button>
                    @else
                        <flux:button variant="danger" wire:click="markUnpaid">Return to Unpaid</flux:button>
                    @endif
                    
                </div>

            @endif
        </div>
    </flux:modal>
</div>