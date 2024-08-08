<x-layout>
    <x-slot name="header">
        {{ $school->name }}
    </x-slot>
    <x-container>
        <x-block>
            <x-slot name="heading">
                <x-button type="a" href="{{ route('school.index') }}">Back</x-button>
                Details of {{ $school->name }}
            </x-slot>
            
            <div class="form-group row pt-2">
                <div class="col-md-3">
                    <x-input-label>School Code</x-input-label>
                </div>
                <div class="col-md-4">
                    <x-text-input class="form-control" disabled value="{{ $school->code }}"/>
                </div>
            </div>
            <div class="form-group row pt-2">
                <div class="col-md-3">
                    <x-input-label>School Name</x-input-label>
                </div>
                <div class="col-md-4">
                    <x-text-input class="form-control" disabled value="{{ $school->name }}"/>
                </div>
            </div>
            @auth
            <div class="form-group row pt-2">
                <div class="col-md-3"></div>
                <div class="col-md-4">
                    <x-button type='a' href="/school/{{ $school->id }}/edit">{{ __('Edit') }}</x-button>
                    <x-button type="delete" form="delete-form">Delete</x-button>
                    <form method="post" id="delete-form" action="/school/{{ $school->id }}" onsubmit="return confirm('Are you sure you want to delete?')">
                        @csrf
                        @method('delete')
                    </form>
                </div>
            </div>
            @endauth
        </x-block>
        <x-block>
            <x-slot name="heading">
                Departments under {{ $school->name }}
            </x-slot>
            @if(count($school->departments)>0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th>School Name</th><th>Department Code</th><th>Department Name</th><tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($school->departments as $dept)
                        <tr class="bg-white-100 hover:bg-sky-700 text-white-900">
                            <td>{{ $dept->school->name }}</td>
                            <td><a  href="/department/{{ $dept->id }}">{{ $dept->code }}</a></td>
                            <td>{{ $dept->name }}</td>
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
