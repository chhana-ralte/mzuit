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
                <div class="form-group row pt-2">
                    <div class="col-md-3"></div>
                    <div class="col-md-4">
                        <x-button type='a' href="/school/{{ $school->id }}">Cancel</x-button>
                        <x-button type="submit">Update</x-button>
                    </div>
                </div>
            </form>
        </x-block>
    </x-container>
</x-layout>
