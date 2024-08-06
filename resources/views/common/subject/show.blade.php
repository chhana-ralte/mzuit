<x-layout>
    <x-slot name="header">
    <x-button type="a" href="{{ route('syllabus.show',[$subject->syllabus->id]) }}">Back</x-button>
        {{ __('Subject') }}
    </x-slot>
    <x-container>
        <x-block>
            <x-slot name="block_header">
                {{ $subject->code }}: {{$subject->name}}
            </x-slot>
            <div>
                {{ $subject->contents }}
            </div>
            <div>
                <x-button type="a" href="/subject/{{$subject->id}}/edit">EDIT</x-button>
            </div>
        </x-block>
    </x-container>
</x-layout>
