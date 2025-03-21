<x-layouts.app :title="__('Programs Management')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Programs') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage all of your designed programs here') }}</flux:subheading>
        <flux:separator variant="subtle"></flux:separator>
    </div>

    <livewire:programs.programs />
    
</x-layouts.app>