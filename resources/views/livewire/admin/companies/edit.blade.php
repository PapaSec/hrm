<div
    class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-slate-800 p-6 rounded-lg shadow-md">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Companies</flux:heading>
        <flux:subheading size="lg" class="mb-6">Edit this Company</flux:subheading>
        <flux:separator />
    </div>

    <form wire:submit="save" class="my-6 w-full space-y-6">
        <flux:input label="Company Name" wire:model.live="company.name" :invalid="$errors->has('company.name')"
            type="text" />
        <flux:input label="Email Address" wire:model.live="company.email" :invalid="$errors->has('company.email')"
            type="email" />
        <flux:input label="Company Website" wire:model.live="company.website" :invalid="$errors->has('company.website')"
            type="url" />
        <flux:input label="Company Logo" wire:model.live="logo" :invalid="$errors->has('logo')" type="file" />
        <button type="submit"
            class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-all transform hover:scale-[1.02] active:scale-[0.98]">
            Save Changes
        </button>
    </form>
</div>