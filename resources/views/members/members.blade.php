<x-layouts.app :title="__('Members Management')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Members') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage all of your gym members here') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <livewire:members.members />
</x-layouts.app>
