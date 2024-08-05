<x-layout>
    <x-slot name="header">
    <x-button type="a" href="{{ route('school.show',[$department->school_id]) }}">Back</x-button>
        {{ $department->name }}
    </x-slot>
    <x-container>
        <x-block>
            <x-slot name="block_header">
                Details of {{ $department->name }}
            </x-slot>
            
            <div>
                <x-input-label>School Code</x-input-label>
                <x-text-input disabled value="{{ $department->school->code }}"/>
            </div>
            <div>
                <x-input-label>Department Code</x-input-label>
                <x-text-input disabled value="{{ $department->code }}"/>
            </div>
            <div>
                <x-input-label>Department Name</x-input-label>
                <x-text-input disabled value="{{ $department->name }}"/>
            </div>
            <div>
                <x-button type='a' href="/department/{{ $department->id }}/edit">{{ __('Edit') }}</x-button>
                <x-button type="delete" form="delete-form">Delete</x-button>
                <form method="post" id="delete-form" action="/department/{{ $department->id }}" onsubmit="return confirm('Are you sure you want to delete?')">
                    @csrf
                    @method('delete')
                </form>
            </div>
        </x-block>
        <x-block>
            <x-slot name="block_header">
                Courses under {{ $department->name }}
            </x-slot>
            @if(count($department->courses)>0)
                <table class="table-hover table-auto">
                    <thead>
                        <tr>
                        <th>Department Name</th><th>Course Code</th><th>Course Name</th><th>Max sem</th><tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($department->courses as $c)
                        <tr class="bg-white-100 hover:bg-sky-700 text-white-900">
                            <td>{{ $c->department->name }}</td>
                            <td><a  href="/course/{{ $c->id }}">{{ $c->code }}</a></td>
                            <td>{{ $c->name }}</td>
                            <td>{{ $c->max_sem }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                No School available
            @endif
        </x-block>            
    </x-container>
</x-layout>
