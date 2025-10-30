<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div class="flex items-center">
    <div class="flex-shrink-0">
        <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
            {{ substr(auth()->user()->name, 0, 2) }}
        </div>
    </div>
    <div class="ml-3 flex-1 min-w-0">
        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
            {{ auth()->user()->name }}
        </p>
        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
            {{ auth()->user()->roles->first()?->name ?? 'Utilisateur' }}
        </p>
    </div>
    <button wire:click="logout" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" title="Déconnexion">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
        </svg>
    </button>
</div>

