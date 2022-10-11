<x-layout>
    <x-slot name="header">
        {{ __('Class types') }}
    </x-slot>

    <x-panel class="flex flex-col items-center pt-16 pb-16">

        <div class="mt-8 text-2xl">

            <x-splade-table :for="$class_types">
                @cell('actions', $class_types)
                    <a href="/class-types/{{ $class_types->id }}/edit" class="text-orange-400"> Edit </a>
                @endcell
            </x-splade-table>

        </div>

    </x-panel>
</x-layout>
