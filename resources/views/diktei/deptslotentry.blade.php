<x-diktei>
    <x-container>
        <x-block>
            <x-slot name="heading">
                Department slot entry.
            </x-slot>
            <form method="post" action="/diktei/deptslotentry">
                @csrf
                @foreach($departments as $dep)
                <div class="form-group row p-2">
                    <div class="col-md-3">
                        <x-input-label for="{{ $dep->code }}" value="{{ $dep->name }}" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="{{$dep->id}}" name="department[{{$dep->id}}]" type="text" class="form-control" value="{{ $dep->slot() }}" />
                        <x-input-error class="mt-2" :messages="$errors->get('{{$dep->code}}')" />
                    </div>
                </div>
                @endforeach
                <div class="form-group row">
                    <div class="col-md-3"></div>
                    <div class="col-md-4">
                        <x-button type="submit">{{ __('Save') }}</x-button>
                    </div>
                </div>
            </form>
        </x-block>
    </x-container>
</x-diktei>