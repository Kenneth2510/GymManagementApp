<x-layouts.app :title="__('Attendances')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Attendances') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage Members Time In and Out here') }}</flux:subheading>
        <flux:separator variant="subtle"></flux:separator>
    </div>

    <livewire:attendances.attendances />
</x-layouts.app>