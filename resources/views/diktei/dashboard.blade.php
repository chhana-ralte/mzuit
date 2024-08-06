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
                        <x-input-label for="name" value="Enter your name"/>
                    </div>
                    <div class="col-md-4">
                        <x-text-input name="name" type="text" class="form-control" value="" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                </div>
                <div class="form-group row p-2">
                    <div class="col-md-3">
                        <x-input-label for="name" value="Enter your rollno/registration/admission no" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="rollno" name="rollno" type="text" class="form-control" value="" required autocomplete="rollno" />
                        <x-input-error class="mt-2" :messages="$errors->get('rollno')" />
                    </div>
                </div>
                <div class="form-group row p-2">
                    <div class="col-md-3">
                        <x-input-label for="department" value="Select your department" />
                    </div>
                    <div class="col-md-4">
                        <x-select name="department" class="form-control">
                        @foreach($departments as $dept)
                            @if($dept->slot())
                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endif
                        @endforeach
                        </x-select>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('department')" />
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