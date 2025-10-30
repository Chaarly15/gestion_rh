<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>HRM System</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                background: linear-gradient(135deg, #1E3A8A 0%, #3B82F6 100%);
            }
            .dark body {
                background: linear-gradient(135deg, #1F2937 0%, #374151 100%);
            }
        </style>
    </head>
    <body class="antialiased font-sans">
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#1E3A8A] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="flex items-center justify-between py-10">
                        <div class="flex items-center">
                            <svg class="h-12 w-auto text-white lg:h-16 lg:text-[#1E3A8A] dark:text-[#3B82F6]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2a10 10 0 0 0-7.35 16.83l1.41-1.41A8 8 0 1 1 12 20a8 8 0 0 1-4.24-1.26l-1.41 1.41A10 10 0 1 0 12 2zm0 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0-4a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" fill="currentColor"/>
                            </svg>
                            <span class="ml-4 text-2xl font-semibold text-white dark:text-white">HRM System</span>
                        </div>
                        @if (Route::has('login'))
                            <livewire:welcome.navigation />
                        @endif
                    </header>

                    <main class="mt-6">
                        <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                            <a
                                href="/employees"
                                id="employees-card"
                                class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#1E3A8A] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#1E3A8A]"
                            >
                                <div id="screenshot-container" class="relative flex w-full flex-1 items-stretch">
                                    <img
                                        src="https://via.placeholder.com/600x400?text=Employee+Management"
                                        alt="Employee management screenshot"
                                        class="aspect-video h-full w-full flex-1 rounded-[10px] object-top object-cover drop-shadow-[0px_4px_34px_rgba(0,0,0,0.06)] dark:hidden"
                                        onerror="
                                            document.getElementById('screenshot-container').classList.add('!hidden');
                                            document.getElementById('employees-card').classList.add('!row-span-1');
                                            document.getElementById('employees-card-content').classList.add('!flex-row');
                                        "
                                    />
                                    <img
                                        src="https://via.placeholder.com/600x400?text=Employee+Management+Dark"
                                        alt="Employee management screenshot"
                                        class="hidden aspect-video h-full w-full flex-1 rounded-[10px] object-top object-cover drop-shadow-[0px_4px_34px_rgba(0,0,0,0.25)] dark:block"
                                    />
                                    <div
                                        class="absolute -bottom-16 -left-16 h-40 w-[calc(100%+8rem)] bg-gradient-to-b from-transparent via-white to-white dark:via-zinc-900 dark:to-zinc-900"
                                    ></div>
                                </div>

                                <div class="relative flex items-center gap-6 lg:items-end">
                                    <div id="employees-card-content" class="flex items-start gap-6 lg:flex-col">
                                        <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#1E3A8A]/10 sm:size-16">
                                            <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <path fill="#1E3A8A" d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                            </svg>
                                        </div>

                                        <div class="pt-3 sm:pt-5 lg:pt-0">
                                            <h2 class="text-xl font-semibold text-black dark:text-white">Employee Management</h2>
                                            <p class="mt-4 text-sm/relaxed">
                                                Manage employee profiles, roles, and departments with ease. Access detailed records, update information, and streamline HR processes.
                                            </p>
                                        </div>
                                    </div>
                                    <svg class="size-6 shrink-0 stroke-[#1E3A8A]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
                                    </svg>
                                </div>
                            </a>

                            <a
                                href="/payroll"
                                class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#1E3A8A] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#1E3A8A]"
                            >
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#1E3A8A]/10 sm:size-16">
                                    <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path fill="#1E3A8A" d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-8 14H4v-2h8v2zm0-4H4v-2h8v2zm0-4H4V8h8v2zm6 8h-4v-2h4v2zm0-4h-4v-2h4v2zm0-4h-4V8h4v2z"/>
                                    </svg>
                                </div>
                                <div class="pt-3 sm:pt-5">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">Payroll Processing</h2>
                                    <p class="mt-4 text-sm/relaxed">
                                        Automate payroll calculations, manage salaries, deductions, and bonuses. Generate reports and ensure compliance with ease.
                                    </p>
                                </div>
                                <svg class="size-6 shrink-0 self-center stroke-[#1E3A8A]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
                                </svg>
                            </a>

                            <a
                                href="/attendance"
                                class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#1E3A8A] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#1E3A8A]"
                            >
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#1E3A8A]/10 sm:size-16">
                                    <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path fill="#1E3A8A" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
                                    </svg>
                                </div>
                                <div class="pt-3 sm:pt-5">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">Attendance Tracking</h2>
                                    <p class="mt-4 text-sm/relaxed">
                                        Monitor employee attendance, leaves, and work hours. Integrate with time-tracking tools for accurate records and analytics.
                                    </p>
                                </div>
                                <svg class="size-6 shrink-0 self-center stroke-[#1E3A8A]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
                                </svg>
                            </a>

                            <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800">
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#1E3A8A]/10 sm:size-16">
                                    <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path fill="#1E3A8A" d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-2 10h-4v2h4v-2zm-4-2h4v-2h-4v2zm-6 2H4v-2h4v2zm0-4H4v-2h4v2zm6 0h-4v-2h4v2z"/>
                                    </svg>
                                </div>
                                <div class="pt-3 sm:pt-5">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">Recruitment Portal</h2>
                                    <p class="mt-4 text-sm/relaxed">
                                        Streamline hiring with our recruitment portal. Post jobs, manage applications, and track candidate progress seamlessly.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </main>

                    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                        HRM System v1.0.0 (PHP v{{ PHP_VERSION }})
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>