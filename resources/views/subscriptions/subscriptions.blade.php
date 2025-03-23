<x-layouts.app :title="__('Subscriptions')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Subscriptions') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage Member Subscriptions here') }}</flux:subheading>
        <flux:separator variant="subtle"></flux:separator>
    </div>

    <livewire:subscriptions.subscriptions />
    
</x-layouts.app>