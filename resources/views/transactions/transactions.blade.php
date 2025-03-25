<x-layouts.app :title="__('Transactions')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Transactions') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage Subscriptions Transactions here') }}</flux:subheading>
        <flux:separator variant="subtle"></flux:separator>
    </div>

    <livewire:transactions.transactions />
</x-layouts.app>