<x-layout>
    <x-slot name="header">
        <x-button type="a" href="{{ route('enroll.show',[$enroll->id]) }}">Back</x-button>
        {{ $enroll->student->person->name }}
    </x-slot>
    <x-container>
        <x-block class="col-md-4">
            <x-slot name="heading">
                <x-button type="a" href="{{ route('enroll.show',[$enroll->id]) }}">Back</x-button>
                Personal Details
            </x-slot>
            <form method="post" id="personal" action="{{ route('enroll.update',$enroll->id) }}" class="mt-6 space-y-6">
                @csrf
                @method('patch')
                <input type="hidden" name="updateType" value="personal">
                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="name" :value="__('Name')" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name', $enroll->student->person->name)" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="father" value="Father's name" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="father" name="father" type="text" class="form-control" :value="old('father', $enroll->student->person->father)" autocomplete="father" />
                        <x-input-error class="mt-2" :messages="$errors->get('father')" />
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="dob" :value="__('Date of birth')" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="dob" name="dob" type="date" class="form-control" :value="old('dob', $enroll->student->person->dob)" autocomplete="dob" />
                        <x-input-error class="mt-2" :messages="$errors->get('dob')" />  
                    </div>  
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="email" :value="__('Email')" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="email" name="email" type="email" class="form-control" :value="old('email', $enroll->student->person->email)" autocomplete="email" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />    
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="phone" :value="__('phone')" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="phone" name="phone" type="text" class="form-control" :value="old('phone', $enroll->student->person->phone)" autocomplete="phone" />
                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />    
                    </div>
                </div>


                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="category" :value="__('Category')" />
                    </div>
                    <div class="col-md-4">
                        <x-select name='category' class="form-control">
                            <option value="" {{$enroll->student->person->category==""?' selected ':''}}>Select Category</option>
                            <option value="General" {{$enroll->student->person->category=="General"?' selected ':''}}>General</option>
                            <option value="SC" {{$enroll->student->person->category=="SC"?' selected ':''}}>SC</option>
                            <option value="ST" {{$enroll->student->person->category=="ST"?' selected ':''}}>ST</option>
                            <option value="OBC" {{$enroll->student->person->category=="OBC"?' selected ':''}}>OBC</option>
                            <option value="EWS" {{$enroll->student->person->category=="EWS"?' selected ':''}}>EWS</option>
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('category')" />    
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        
                    </div>
                    <div class="col-md-4">
                        <x-button type="submit" form="personal">{{ __('Save') }}</x-button>
                    </div>
                </div>
            </form>

        </x-block>
        <x-block>
            <x-slot name="heading">
                Student's Details
            </x-slot>
            <form id="student" method="post" action="{{ route('enroll.update',$enroll->id) }}">
                @csrf
                @method('patch')
                <input type="hidden" name="updateType" value="student">
                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="rollno" value="Rollno" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input name="rollno" type="text" class="form-control" value='{{ $enroll->student->rollno }}' autocomplete="rollno" />
                        <x-input-error class="mt-2" :messages="$errors->get('rollno')" />
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="phone" :value="__('Phone')" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="phone" name="phone" type="text" class="form-control" :value="old('phone', $enroll->student->person->phone)" autocomplete="phone" />
                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />    
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="registration" value="Registration" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input name="registration" type="text" class="form-control" value='{{ $enroll->student->registration }}' autocomplete="registration"/>
                        <x-input-error class="mt-2" :messages="$errors->get('registration')" />
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">

                        <x-input-label for="type" value="Type" />
                    </div>
                    <div class="col-md-4">
                        <select name="type" class="form-control">
                            <option>None</option>
                            <option value="Regular" {{ $enroll->student->type=="Regular"?" selected ":""}}>Regular</option>
                            <option value="Lateral" {{ $enroll->student->type=="Lateral"?" selected ":""}}>Lateral</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('type')" />
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">

                        <x-input-label for="batch" value="Batch" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input name="batch" type="text" class="form-control" value='{{ $enroll->student->sessn->start_yr }}' autocomplete="batch"/>
                        <x-input-error class="mt-2" :messages="$errors->get('batch')" />
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3"></div>
                    <div class="col-md-4">
                        <x-button type="submit" form="student">{{ __('Save') }}</x-button>
                    </div>
                </div>
            </form>
        </x-block>

        <x-block>
            <x-slot name="block_header">
                Enrollment details
            </x-slot>
            <table class="table-fixed">
                <tr>
                    <th>Enrolment session</th>
                    <th>Semester in which enrolled</th>
                </tr>
                @foreach($enroll->student->enrolls as $e)
                <tr>
                    <td>{{ $e->sessn->name() }}</th>
                    <td class="text-center">{{ $e->semester }}</td>
                </tr>
                @endforeach
            </table>
        </x-block>
    </x-container>
</x-layout>
