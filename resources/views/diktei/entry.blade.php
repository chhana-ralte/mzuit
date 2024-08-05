<x-diktei>
    <x-container>
        <x-block>
        <x-slot name="block_header">
                Student's Details
            </x-slot>
            <form method="post" action="/diktei/entry">
                @csrf
                <div>
                    <x-input-label for="name" value="Enter your name" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                <div>
                    <x-input-label for="name" value="Enter your rollno/registration/admission no" />
                    <x-text-input id="rollno" name="rollno" type="text" class="mt-1 block w-full" value="" required autocomplete="rollno" />
                    <x-input-error class="mt-2" :messages="$errors->get('rollno')" />
                </div>
                <div>
                    <x-input-label for="department" value="Select your department" />
                    <x-select name="department" class="mt-1 block w-full">
                        @foreach(App\Models\Department::orderBy('name')->get() as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endforeach
                    </x-select>

                    <x-input-error class="mt-2" :messages="$errors->get('department')" />
                </div>
                <div class="flex items-center gap-4 pt-4">
                    <x-button type="submit">{{ __('Proceed') }}</x-button>
                </div>
            </form>
        </x-block>
        <x-block>
            <x-slot:heading>
                Select the subjects in order of preference.
            </x-slot:heading>
            <form method="post" action="/diktei/store">
                <div>
                    @for($i=1;$i<=10;$i++)
                        <x-input-label for="department" value="{{ 'Option: ' . $i }}" />
                        <x-select name="department[]" class="mt-1 block w-full">
                            @foreach(App\Models\Department::orderBy('name')->get() as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </x-select>
                    @endfor
                </div>
            </form>
        </x-block>
    </x-container>

</x-diktei>