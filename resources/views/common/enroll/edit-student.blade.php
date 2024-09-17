<x-layout>
    <x-slot name="header">
        <x-button type="a" href="{{ route('enroll.show',[$enroll->id]) }}">Back</x-button>
        {{ $enroll->student->person->name }}
    </x-slot>
    <x-container>
        <x-block>
            <x-slot name="heading">
                <x-button type="a" href="{{ route('enroll.show',[$enroll->id]) }}">Back</x-button>
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
                    <div class="col-md-3">
                        <x-input-label for="status" value="Status" />
                    </div>
                    <div class="col-md-4">
                        <select name="status" class="form-control">
                            <option value="Ongoing">Ongoing</option>
                            <option value="Completed"  {{$student->completed?' selected ':'' }}>Completed</option>
                            <option value="Dropped out" {{$student->dropout?' selected ':'' }}>Dropped out</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('status')" />
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3"></div>
                    <div class="col-md-4">
                        <x-button type="a" href="{{ route('enroll.show',[$enroll->id]) }}">Cancel</x-button>
                        <x-button type="submit" form="student">{{ __('Save') }}</x-button>
                    </div>
                </div>
            </form>
        </x-block>
    </x-container>
</x-layout>
