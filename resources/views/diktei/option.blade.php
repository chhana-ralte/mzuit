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
                        <x-input-label for="name" value="Rollno" />
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
        @if($done)
            <x-block>
                <x-slot:heading>
                    Already done for the student. Preferences are:
                </x-slot:heading>
                <h2>IMJ</h2>
                    @foreach($imjoptions as $opt)
                        <div>Option {{$opt->option}}: {{$opt->dtcourse->code}}: {{$opt->dtcourse->title}}</div>
                    @endforeach
                    <h2>IMN</h2>
                    @foreach($imnoptions as $opt)
                        <div>Option {{$opt->option}}: {{$opt->dtcourse->code}}: {{$opt->dtcourse->title}}</div>
                    @endforeach
            </x-block>
        @else
            <form method="post" action="/diktei/option_store">
                @csrf
                <input type="hidden" name="diktei_id" value="{{ $diktei->id }}">
                <x-block>
                    <x-slot:heading>
                        Select the IMJ courses in order of your preference.
                    </x-slot:heading>
                    <div>
                        @for($i=1;$i<=10;$i++)
                        <div class="form-group row pt-2">
                            <div class="col-md-3">
                                <x-input-label for="subject" value="{{ 'Option: ' . $i }}" />
                            </div>
                            <div class="col-md-4">
                                <x-select name="imj[]" class="form-control">
                                    <option value='0'>None</option>
                                    @foreach($majors as $maj)
                                        @if($maj->intake > 0)
                                            <option value="{{ $maj->id }}">{{ $maj->code }}: {{ $maj->title }}</option>
                                        @endif
                                    @endforeach
                                </x-select>
                            </div>
                        </div>
                        @endfor
                    </div>
                </x-block>


                <x-block>
                    <x-slot:heading>
                        Select the IMN courses in order of your preference.
                    </x-slot:heading>
                    <div>
                        @for($i=1;$i<=10;$i++)
                        <div class="form-group row pt-2">
                            <div class="col-md-3">
                                <x-input-label for="subject" value="{{ 'Option: ' . $i }}" />
                            </div>
                            <div class="col-md-4">
                                <x-select name="imn[]" class="form-control">
                                    <option value='0'>None</option>
                                    @foreach($minors as $min)
                                        @if($min->intake > 0)
                                            <option value="{{ $min->id }}">{{ $min->code }}: {{ $min->title }}</option>
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
                </x-block>
            </form>
        @endif
    </x-container>
</x-diktei>