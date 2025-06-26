<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-nos-800">
    <!-- Top Navbar -->
    <flux:header
        class="sticky top-0 z-50 h-18 border-b border-zinc-200 bg-gray-800 dark:border-gray-800 dark:bg-gray-800">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>

        <flux:spacer />

        <!-- User Profile Dropdown -->
        <flux:dropdown position="bottom" align="end">
            <flux:profile :name="auth()->user()->name" :initials="auth()->user()->initials()"
                icon-trailing="chevrons-up-down" />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    <!-- Sidebar Navigation -->
    <flux:sidebar sticky stashable class="border-e border-white/10 sidebar-gradient sidebar-shadow backdrop-blur-lg">

        <!-- Dashboard -->
        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('NAVIGATION')" class="mb-1">
                <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')"
                    wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
            </flux:navlist.group>

            <!-- Companies -->
            <flux:navlist.group class="grid mb-1"
                x-data="{ open: {{ request()->routeIs(['companies.index', 'companies.create']) ? 'true' : 'false' }} }">
                <flux:navlist.item as="button" :current="request()->routeIs(['companies.index', 'companies.create'])"
                    @click="open = !open">
                    <span class="flex items-center justify-between w-full">
                        <span class="flex items-center">
                            <flux:icon name="rectangle-group" class="mr-2" />
                            {{ __('Companies') }}
                        </span>
                        <svg x-show="!open" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                        <svg x-show="open" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </span>
                </flux:navlist.item>
                <div x-show="open" x-transition class="ml-6 space-y-1">
                    <flux:navlist.item icon="list-bullet" :href="route('companies.index')" class="hover:bg-transparent"
                        :class="request()->routeIs('companies.index') ? 'text-blue-600' : ''" wire:navigate>
                        {{ __('List of Companies') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="plus" :href="route('companies.create')" class="hover:bg-transparent"
                        :class="request()->routeIs('companies.create') ? 'text-blue-600' : ''" wire:navigate>
                        {{ __('Add Company') }}
                    </flux:navlist.item>
                </div>
            </flux:navlist.group>

            <!-- Departments -->
            <flux:navlist.group class="grid mb-1"
                x-data="{ open: {{ request()->routeIs(['departments.index', 'departments.create']) ? 'true' : 'false' }} }">
                <flux:navlist.item as="button"
                    :current="request()->routeIs(['departments.index', 'departments.create'])" @click="open = !open">
                    <span class="flex items-center justify-between w-full">
                        <span class="flex items-center">
                            <flux:icon name="building-office-2" class="mr-2" />
                            {{ __('Departments') }}
                        </span>
                        <svg x-show="!open" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                        <svg x-show="open" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </span>
                </flux:navlist.item>
                <div x-show="open" x-transition class="ml-6 space-y-1">
                    <flux:navlist.item icon="list-bullet" :href="route('departments.index')"
                        class="hover:bg-transparent"
                        :class="request()->routeIs('departments.index') ? 'text-blue-600' : ''" wire:navigate>
                        {{ __('List of Departments') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="plus" :href="route('departments.create')" class="hover:bg-transparent"
                        :class="request()->routeIs('departments.create') ? 'text-blue-600' : ''" wire:navigate>
                        {{ __('Add Department') }}
                    </flux:navlist.item>
                </div>
            </flux:navlist.group>

            <!-- Designations -->
            <flux:navlist.group class="grid mb-1"
                x-data="{ open: {{ request()->routeIs(['designations.index', 'designations.create']) ? 'true' : 'false' }} }">
                <flux:navlist.item as="button"
                    :current="request()->routeIs(['designations.index', 'designations.create'])" @click="open = !open">
                    <span class="flex items-center justify-between w-full">
                        <span class="flex items-center">
                            <flux:icon name="briefcase" class="mr-2" />
                            {{ __('Designations') }}
                        </span>
                        <svg x-show="!open" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                        <svg x-show="open" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </span>
                </flux:navlist.item>
                <div x-show="open" x-transition class="ml-6 space-y-1">
                    <flux:navlist.item icon="list-bullet" :href="route('designations.index')"
                        class="hover:bg-transparent"
                        :class="request()->routeIs('designations.index') ? 'text-blue-600' : ''" wire:navigate>
                        {{ __('List of Designations') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="plus" :href="route('designations.create')" class="hover:bg-transparent"
                        :class="request()->routeIs('designations.create') ? 'text-blue-600' : ''" wire:navigate>
                        {{ __('Add Designation') }}
                    </flux:navlist.item>
                </div>
            </flux:navlist.group>

            <!-- Employees -->
            <flux:navlist.group class="grid mb-1"
                x-data="{ open: {{ request()->routeIs(['employees.index', 'employees.create']) ? 'true' : 'false' }} }">
                <flux:navlist.item as="button" :current="request()->routeIs(['employees.index', 'employees.create'])"
                    @click="open = !open">
                    <span class="flex items-center justify-between w-full">
                        <span class="flex items-center">
                            <flux:icon name="users" class="mr-2" />
                            {{ __('Employees') }}
                        </span>
                        <svg x-show="!open" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                        <svg x-show="open" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </span>
                </flux:navlist.item>
                <div x-show="open" x-transition class="ml-6 space-y-1">
                    <flux:navlist.item icon="list-bullet" :href="route('employees.index')" class="hover:bg-transparent"
                        :class="request()->routeIs('employees.index') ? 'text-blue-600' : ''" wire:navigate>
                        {{ __('List of Employees') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="plus" :href="route('employees.create')" class="hover:bg-transparent"
                        :class="request()->routeIs('employees.create') ? 'text-blue-600' : ''" wire:navigate>
                        {{ __('Add Employee') }}
                    </flux:navlist.item>
                </div>
            </flux:navlist.group>

            <!-- Contracts -->
            <flux:navlist.group class="grid mb-1"
                x-data="{ open: {{ request()->routeIs(['contracts.index', 'contracts.create']) ? 'true' : 'false' }} }">
                <flux:navlist.item as="button" :current="request()->routeIs(['contracts.index', 'contracts.create'])"
                    @click="open = !open">
                    <span class="flex items-center justify-between w-full">
                        <span class="flex items-center">
                            <flux:icon name="document-text" class="mr-2" />
                            {{ __('Contracts') }}
                        </span>
                        <svg x-show="!open" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                        <svg x-show="open" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </span>
                </flux:navlist.item>
                <div x-show="open" x-transition class="ml-6 space-y-1">
                    <flux:navlist.item icon="list-bullet" :href="route('contracts.index')" class="hover:bg-transparent"
                        :class="request()->routeIs('contracts.index') ? 'text-blue-600' : ''" wire:navigate>
                        {{ __('List of Contracts') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="plus" :href="route('contracts.create')" class="hover:bg-transparent"
                        :class="request()->routeIs('contracts.create') ? 'text-blue-600' : ''" wire:navigate>
                        {{ __('Add Contract') }}
                    </flux:navlist.item>
                </div>
            </flux:navlist.group>

            <!-- Payroll -->
            <flux:navlist.group class="grid mb-1"
                x-data="{ open: {{ request()->routeIs('payrolls.index') ? 'true' : 'false' }} }">
                <flux:navlist.item as="button" :current="request()->routeIs('payrolls.index')" @click="open = !open">
                    <span class="flex items-center justify-between w-full">
                        <span class="flex items-center">
                            <flux:icon name="calculator" class="mr-2" />
                            {{ __('Accounting') }}
                        </span>
                        <svg x-show="!open" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                        <svg x-show="open" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </span>
                </flux:navlist.item>
                <div x-show="open" x-transition class="ml-6 space-y-1">
                    <flux:navlist.item icon="eye" :href="route('payrolls.index')" class="hover:bg-transparent"
                        :class="request()->routeIs('payroll.show') ? 'text-blue-600' : ''" wire:navigate>
                        {{ __('Show Payroll') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="credit-card" :href="route('payments.index')" class="hover:bg-transparent"
                        :class="request()->routeIs('payments.show') ? 'text-blue-600' : ''" wire:navigate>
                        {{ __('Payroll Payments') }}
                    </flux:navlist.item>
                </div>
            </flux:navlist.group>

            <p class="text-red-500">{{ session('message') }}</p>
        </flux:navlist>

        <flux:spacer />

        <flux:navlist variant="outline">
            <flux:navlist.item icon="folder-git-2" href="https://github.com/PapaSec/hrm" target="_blank">
                {{ __('Repository') }}
            </flux:navlist.item>
        </flux:navlist>

        <flux:dropdown>
            <flux:profile :name="App\Models\Company::find(session('company_id'))->name??'Select Company'"
                :initials="App\Models\Company::find(session('company_id'))->initials??'N/A'"
                icon-trailing="chevrons-up-down" />
            <flux:menu>
                @foreach (auth()->user()->companies as $company)
                    <flux:menu.radio.group>
                        @livewire('company-switch', ['company' => $company], key($company->id))
                    </flux:menu.radio.group>
                @endforeach
            </flux:menu>
        </flux:dropdown>
        @if(session()->has('errorMsg'))
            <x-auth-session-status class="text-cent text-red-500" :status="session('errorMsg')"></x-auth-session-status>
        @endif

    </flux:sidebar>

    {{ $slot }}

    @fluxScripts
</body>

</html>