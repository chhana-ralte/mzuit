<x-layout>
    <x-slot name="header">
        <x-button type="a" href="{{ route('enroll.show',[$enroll->id]) }}">Back</x-button>
        {{ $enroll->student->person->name }}
    </x-slot>
    <x-container>
        <x-block class="col-md-4">
            <x-slot name="block_header">
                Personal Details
            </x-slot>
            <form method="post" id="personal" action="{{ route('enroll.update',$enroll->id) }}" class="mt-6 space-y-6">
                @csrf
                @method('patch')
                <input type="hidden" name="type" value="personal">
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $enroll->student->person->name)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="father" value="Father's name" />
                    <x-text-input id="father" name="father" type="text" class="mt-1 block w-full" :value="old('father', $enroll->student->person->father)" autocomplete="father" />
                    <x-input-error class="mt-2" :messages="$errors->get('father')" />
                </div>

                <div>
                    <x-input-label for="dob" :value="__('Date of birth')" />
                    <x-text-input id="dob" name="dob" type="date" class="mt-1 block w-full" :value="old('dob', $enroll->student->person->dob)" autocomplete="dob" />
                    <x-input-error class="mt-2" :messages="$errors->get('dob')" />    
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $enroll->student->person->email)" autocomplete="email" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />    
                </div>

                <div>
                    <x-input-label for="phone" :value="__('phone')" />
                    <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $enroll->student->person->phone)" autocomplete="phone" />
                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />    
                </div>


                <div>
                    <x-input-label for="category" :value="__('Category')" />
                    <x-select name='category' class="mt-1 block w-full">
                        <option value="" {{$enroll->student->person->category==""?' selected ':''}}>Select Category</option>
                        <option value="General" {{$enroll->student->person->category=="General"?' selected ':''}}>General</option>
                        <option value="SC" {{$enroll->student->person->category=="SC"?' selected ':''}}>SC</option>
                        <option value="ST" {{$enroll->student->person->category=="ST"?' selected ':''}}>ST</option>
                        <option value="OBC" {{$enroll->student->person->category=="OBC"?' selected ':''}}>OBC</option>
                        <option value="EWS" {{$enroll->student->person->category=="EWS"?' selected ':''}}>EWS</option>
                    </x-select>
                    <x-input-error class="mt-2" :messages="$errors->get('category')" />    
                </div>
                <div class="flex items-center gap-4">
                    <x-button type="submit" form="personal">{{ __('Save') }}</x-button>
                </div>
            </form>

        </x-block>
        <x-block>
            <x-slot name="block_header">
                Student's Details
            </x-slot>
            <form id="student" method="post" action="{{ route('enroll.update',$enroll->id) }}">
                @csrf
                @method('patch')
                <input type="hidden" name="type" value="student">
                <div>
                    <x-input-label for="rollno" value="Rollno" />
                    <x-text-input name="rollno" type="text" class="mt-1 block w-full" value='{{ $enroll->student->rollno }}' autocomplete="rollno" />
                    <x-input-error class="mt-2" :messages="$errors->get('rollno')" />
                </div>

                <div class="pt-4">
                    <x-input-label for="phone" :value="__('Phone')" />
                    <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $enroll->student->person->phone)" autocomplete="phone" />
                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />    
                </div>

                <div class="pt-4">
                    <x-input-label for="registration" value="Registration" />
                    <x-text-input name="registration" type="text" class="mt-1 block w-full" value='{{ $enroll->student->registration }}' autocomplete="registration"/>
                    <x-input-error class="mt-2" :messages="$errors->get('registration')" />
                </div>

                <div class="pt-4">
                    <x-input-label for="batch" value="Batch" />
                    <x-text-input name="batch" type="text" class="mt-1 block w-full" value='{{ $enroll->student->sessn->start_yr }}' autocomplete="batch"/>
                    <x-input-error class="mt-2" :messages="$errors->get('batch')" />
                </div>

                <div class="flex items-center gap-4 pt-4">
                    <x-button type="submit" form="student">{{ __('Save') }}</x-button>
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
