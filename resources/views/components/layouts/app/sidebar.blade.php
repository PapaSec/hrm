<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
    <style>
        .sidebar-gradient {
            background: linear-gradient(195deg, rgba(17, 24, 39, 0.95) 0%, rgba(31, 41, 55, 0.95) 100%);
        }

        .sidebar-shadow {
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
        }

        .nav-item {
            transition: all 0.2s ease;
            border-radius: 0.375rem;
            margin: 0.25rem 0.5rem;
        }

        .nav-item:hover {
            background-color: rgba(59, 130, 246, 0.1);
        }

        .nav-item.active {
            background-color: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
        }

        .nav-item.active .icon {
            color: #3b82f6;
        }

        .submenu-item {
            transition: all 0.2s ease;
            padding-left: 2rem;
            border-left: 2px solid transparent;
        }

        .submenu-item:hover {
            border-left-color: #3b82f6;
        }

        .submenu-item.active {
            color: #3b82f6;
            font-weight: 500;
        }

        .company-selector {
            background: rgba(255, 255, 255, 0.05);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
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
    <flux:sidebar sticky stashable
        class="border-e border-white/10 sidebar-gradient sidebar-shadow backdrop-blur-lg w-64">

        <!-- Dashboard -->
        <flux:navlist variant="outline" class="px-2 py-4">
            <flux:navlist.group :heading="__('NAVIGATION')" class="mb-2 px-2">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">{{ __('NAVIGATION') }}</span>
            </flux:navlist.group>

            <flux:navlist.item icon="home" :href="route('dashboard')"
                :class="request()->routeIs('dashboard') ? 'active' : ''" wire:navigate>{{ __('Dashboard') }}
            </flux:navlist.item>

            <!-- Companies -->
            <flux:navlist.group class="grid mb-1"
                x-data="{ open: {{ request()->routeIs(['companies.index', 'companies.create']) ? 'true' : 'false' }} }">
                <flux:navlist.item as="button"
                    :class="request()->routeIs(['companies.index', 'companies.create']) ? 'active' : ''"
                    @click="open = !open" class="nav-item">
                    <span class="flex items-center justify-between w-full">
                        <span class="flex items-center">
                            <flux:icon name="rectangle-group" class="mr-2 icon" />
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
                <div x-show="open" x-transition class="ml-2 space-y-1">
                    <flux:navlist.item icon="list-bullet" :href="route('companies.index')" class="submenu-item"
                        :class="request()->routeIs('companies.index') ? 'active' : ''" wire:navigate>
                        {{ __('List of Companies') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="plus" :href="route('companies.create')" class="submenu-item"
                        :class="request()->routeIs('companies.create') ? 'active' : ''" wire:navigate>
                        {{ __('Add Company') }}
                    </flux:navlist.item>
                </div>
            </flux:navlist.group>

            <!-- Departments -->
            <flux:navlist.group class="grid mb-1"
                x-data="{ open: {{ request()->routeIs(['departments.index', 'departments.create']) ? 'true' : 'false' }} }">
                <flux:navlist.item as="button"
                    :class="request()->routeIs(['departments.index', 'departments.create']) ? 'active' : ''"
                    @click="open = !open" class="nav-item">
                    <span class="flex items-center justify-between w-full">
                        <span class="flex items-center">
                            <flux:icon name="building-office-2" class="mr-2 icon" />
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
                <div x-show="open" x-transition class="ml-2 space-y-1">
                    <flux:navlist.item icon="list-bullet" :href="route('departments.index')" class="submenu-item"
                        :class="request()->routeIs('departments.index') ? 'active' : ''" wire:navigate>
                        {{ __('List of Departments') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="plus" :href="route('departments.create')" class="submenu-item"
                        :class="request()->routeIs('departments.create') ? 'active' : ''" wire:navigate>
                        {{ __('Add Department') }}
                    </flux:navlist.item>
                </div>
            </flux:navlist.group>

            <!-- Designations -->
            <flux:navlist.group class="grid mb-1"
                x-data="{ open: {{ request()->routeIs(['designations.index', 'designations.create']) ? 'true' : 'false' }} }">
                <flux:navlist.item as="button"
                    :class="request()->routeIs(['designations.index', 'designations.create']) ? 'active' : ''"
                    @click="open = !open" class="nav-item">
                    <span class="flex items-center justify-between w-full">
                        <span class="flex items-center">
                            <flux:icon name="briefcase" class="mr-2 icon" />
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
                <div x-show="open" x-transition class="ml-2 space-y-1">
                    <flux:navlist.item icon="list-bullet" :href="route('designations.index')" class="submenu-item"
                        :class="request()->routeIs('designations.index') ? 'active' : ''" wire:navigate>
                        {{ __('List of Designations') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="plus" :href="route('designations.create')" class="submenu-item"
                        :class="request()->routeIs('designations.create') ? 'active' : ''" wire:navigate>
                        {{ __('Add Designation') }}
                    </flux:navlist.item>
                </div>
            </flux:navlist.group>

            <!-- Employees -->
            <flux:navlist.group class="grid mb-1"
                x-data="{ open: {{ request()->routeIs(['employees.index', 'employees.create']) ? 'true' : 'false' }} }">
                <flux:navlist.item as="button"
                    :class="request()->routeIs(['employees.index', 'employees.create']) ? 'active' : ''"
                    @click="open = !open" class="nav-item">
                    <span class="flex items-center justify-between w-full">
                        <span class="flex items-center">
                            <flux:icon name="users" class="mr-2 icon" />
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
                <div x-show="open" x-transition class="ml-2 space-y-1">
                    <flux:navlist.item icon="list-bullet" :href="route('employees.index')" class="submenu-item"
                        :class="request()->routeIs('employees.index') ? 'active' : ''" wire:navigate>
                        {{ __('List of Employees') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="plus" :href="route('employees.create')" class="submenu-item"
                        :class="request()->routeIs('employees.create') ? 'active' : ''" wire:navigate>
                        {{ __('Add Employee') }}
                    </flux:navlist.item>
                </div>
            </flux:navlist.group>

            <!-- Contracts -->
            <flux:navlist.group class="grid mb-1"
                x-data="{ open: {{ request()->routeIs(['contracts.index', 'contracts.create']) ? 'true' : 'false' }} }">
                <flux:navlist.item as="button"
                    :class="request()->routeIs(['contracts.index', 'contracts.create']) ? 'active' : ''"
                    @click="open = !open" class="nav-item">
                    <span class="flex items-center justify-between w-full">
                        <span class="flex items-center">
                            <flux:icon name="document-text" class="mr-2 icon" />
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
                <div x-show="open" x-transition class="ml-2 space-y-1">
                    <flux:navlist.item icon="list-bullet" :href="route('contracts.index')" class="submenu-item"
                        :class="request()->routeIs('contracts.index') ? 'active' : ''" wire:navigate>
                        {{ __('List of Contracts') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="plus" :href="route('contracts.create')" class="submenu-item"
                        :class="request()->routeIs('contracts.create') ? 'active' : ''" wire:navigate>
                        {{ __('Add Contract') }}
                    </flux:navlist.item>
                </div>
            </flux:navlist.group>

            <!-- Payroll -->
            <flux:navlist.group class="grid mb-1"
                x-data="{ open: {{ request()->routeIs('payrolls.index') ? 'true' : 'false' }} }">
                <flux:navlist.item as="button" :class="request()->routeIs('payrolls.index') ? 'active' : ''"
                    @click="open = !open" class="nav-item">
                    <span class="flex items-center justify-between w-full">
                        <span class="flex items-center">
                            <flux:icon name="calculator" class="mr-2 icon" />
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
                <div x-show="open" x-transition class="ml-2 space-y-1">
                    <flux:navlist.item icon="eye" :href="route('payrolls.index')" class="submenu-item"
                        :class="request()->routeIs('payroll.index') ? 'active' : ''" wire:navigate>
                        {{ __('Show Payroll') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="credit-card" :href="route('payrolls.index')" class="submenu-item"
                        :class="request()->routeIs('payments.index') ? 'active' : ''" wire:navigate>
                        {{ __('Payroll Payments') }}
                    </flux:navlist.item>
                </div>
            </flux:navlist.group>

            <p class="text-red-500">{{ session('message') }}</p>
        </flux:navlist>

        <flux:spacer />

        <flux:navlist variant="outline" class="px-2 pb-2">
            <flux:navlist.item icon="folder-git-2" href="https://github.com/PapaSec/hrm" target="_blank"
                class="nav-item">
                {{ __('Repository') }}
            </flux:navlist.item>
        </flux:navlist>

        <div class="company-selector p-4">
            <flux:dropdown class="w-full">
                <flux:profile :name="App\Models\Company::find(session('company_id'))->name??'Select Company'"
                    :initials="App\Models\Company::find(session('company_id'))->initials??'N/A'"
                    icon-trailing="chevrons-up-down" class="w-full" />
                <flux:menu class="w-full">
                    @foreach (auth()->user()->companies as $company)
                        <flux:menu.radio.group>
                            @livewire('company-switch', ['company' => $company], key($company->id))
                        </flux:menu.radio.group>
                    @endforeach
                </flux:menu>
            </flux:dropdown>
        </div>

        @if(session()->has('errorMsg'))
            <x-auth-session-status class="text-cent text-red-500" :status="session('errorMsg')"></x-auth-session-status>
        @endif

    </flux:sidebar>

    {{ $slot }}

    @fluxScripts
</body>

</html>