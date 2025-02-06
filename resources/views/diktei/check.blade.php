<x-diktei>
    <x-container>
        <x-block>
            <x-slot name="heading">
                Check your allotment status
            </x-slot>
            <form method="post" action="/diktei/check">
                @csrf
                <div class="form-group row p-2">
                    <div class="col-md-3">
                        <x-input-label for="name" value="Enter your rollno" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="rollno" name="rollno" type="text" class="form-control" value="{{old('rollno')}}" required autocomplete="rollno" />
                        <x-input-error class="mt-2" :messages="$errors->get('rollno')" />
                    </div>
                </div>

                <div  class="form-group row p-3">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-4">
                        <x-button type="submit">{{ __('Proceed') }}</x-button>
                    </div>
                </div>
            </form>
        </x-block>
    </x-container>
</x-diktei>