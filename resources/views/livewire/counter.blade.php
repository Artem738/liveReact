<div class="text-center mt-10">
    <h2 class="text-xl font-semibold mb-4">Livewire Counter</h2>

    <div class="text-3xl font-bold mb-4">
        {{ $count }}
    </div>

    <button wire:click="increment"
        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
        + Increment
    </button>
</div>
