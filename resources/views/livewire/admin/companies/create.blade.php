<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Companies</flux:heading>
        <flux:subheading size="lg" class="mb-6">List of Companies</flux:subheading>
        <flux:separator />
        <div>

            <form wire:submit="save" class="my-6 w-full space-y-6">
                <flux:input label="Company Name" wire:model.live="company.name" :invalid="$errors" />
            </form>
        </div>