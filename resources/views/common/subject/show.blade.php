<x-layout>
    <x-slot name="header">
    <x-button type="a" href="{{ route('syllabus.show',[$subject->syllabus->id]) }}">Back</x-button>
        {{ __('Subject') }}
    </x-slot>
    <x-container>
        <x-block>
            <x-slot name="heading">
                {{ $subject->code }}: {{$subject->name}}
            </x-slot>
            <div>
                    
                @if(count($subject->contents) > 0)
                <table class="table table-striped">
                    @foreach($subject->contents as $con)
                    <tr><td>
                        {!! $con->content !!}
                    </td></tr>
                    @endforeach
                </table>
                @else
                    <x-button type="a" href="/subject/{{ $subject->id }}/subjectcontent/create">Add</x-button>
                @endif
            </div>
        </x-block>
    </x-container>
</x-layout>
