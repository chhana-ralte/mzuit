<x-diktei>
    <x-container>
        <x-block>
        <x-slot name="heading">
                Student's Details
            </x-slot>
                @csrf
                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="name" value="Name" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="name" name="name" type="text" class="form-control" value="{{ $diktei->name }}" required disabled autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="name" value="Rollno/registration/admission no" />
                    </div>
                    
                    <div class="col-md-4">
                        <x-text-input id="rollno" name="rollno" type="text" class="form-control" value="{{ $diktei->rollno }}" required disabled autocomplete="rollno" />
                        <x-input-error class="mt-2" :messages="$errors->get('rollno')" />
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="department" value="Department" />
                    
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="department" name="department" type="text" class="form-control" value="{{ $diktei->department->name }}" required disabled autocomplete="department" />
                        <x-input-error class="mt-2" :messages="$errors->get('department')" />

                    
                    </div>
                </div>
        </x-block>
        <x-block>
            @if($done)
            <x-slot:heading>
                Already done for the student. Preferences are:
            </x-slot:heading>
                @foreach($diktei->options as $opt)
                    <div>Option {{$opt->option}}: {{$opt->department->name}}</div>
                @endforeach
            @else
            <x-slot:heading>
                Select the subjects in order of preference.
            </x-slot:heading>
            <form method="post" action="/diktei/store">
                @csrf
                <input type="hidden" name="diktei_id" value="{{ $diktei->id }}">
                <div>
                    @for($i=1;$i<=10;$i++)
                    <div class="form-group row pt-2">
                        <div class="col-md-3">
                            <x-input-label for="department" value="{{ 'Option: ' . $i }}" />
                        </div>
                        <div class="col-md-4">
                            <x-select name="department[]" class="form-control">
                                <option value='0'>None</option>
                                @foreach($departments as $dept)
                                    @if($dept->slot())
                                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                    @endif
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    @endfor
                    <div class="form-group row pt-2">
                        <div class="col-md-3">
                        
                        </div>
                        <div class="col-md-4">
                            <x-button type="submit">{{ __('Submit') }}</x-button>
                        </div>
                    </div>
                </div>
            </form>
            @endif
        </x-block>
    </x-container>
</x-diktei>