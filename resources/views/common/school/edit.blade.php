<x-layout>
    <x-slot name="header">
        {{ $school->name }}
    </x-slot>
    <x-container>
        <x-block>
            <x-slot name="block_header">
                Details of {{ $school->name }}
            </x-slot>
            <form method="post" action=" {{route('school.update',$school->id) }}">
                @csrf
                @method('patch')
                <div>
                    <x-input-label>School Code</x-input-label>
                    <x-text-input name='code' value="{{ $school->code }}"/>
                </div>
                <div>
                    <x-input-label>School Name</x-input-label>
                    <x-text-input name='name' value="{{ $school->name }}"/>
                </div>
                <div>
                    <x-button type='a' href="/school/{{ $school->id }}">Cancel</x-button>
                    <x-button type="submit">Update</x-button>
                </div>
            </form>
        </x-block>
    </x-container>
</x-layout>
