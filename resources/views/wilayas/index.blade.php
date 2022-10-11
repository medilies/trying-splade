<x-layout>
    <x-slot name="header">
        Wilayas
    </x-slot>

    <x-panel class="flex flex-col items-center pt-16 pb-16">

        <div class="mt-8 text-2xl">

            <x-splade-table :for="$wilayas" striped />

        </div>

        {{-- <x-splade-data default="{ name: 'Laravel Splade' }">
            <input v-model="data.name" />
        </x-splade-data> --}}

    </x-panel>
</x-layout>
