<x-diktei>
    <x-container>
        <x-block>
            <x-slot name="heading">
                Student's Details
            </x-slot>
            <form method="post" action="/diktei/entry">
                @csrf
                <div class="form-group row p-2">
                    <div class="col-md-3">
                        <x-input-label for="name" value="Enter your rollno as written exactly in your ID" />
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
                        There will be option to select your options after this page.
                        <x-button type="submit">{{ __('Proceed') }}</x-button>
                    </div>
                </div>
            </form>
        </x-block>
    </x-container>
</x-diktei>