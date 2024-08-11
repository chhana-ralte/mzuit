<x-layout>
    <x-container>
        <form method="post" action="{{ route('enroll.store') }}" class="mt-6 space-y-6">
            @csrf
            <input type="hidden" name="sessn" value="{{ $sessn->id }}">
            <input type="hidden" name="course" value="{{ $course->id }}">
            <input type="hidden" name="semester" value="{{ $semester }}">
            <x-block class="col-md-4">
                <x-slot name="heading">
                    <x-button type="a" href="{{ route('course.show',['course'=>$course->id,'sessn'=>$sessn->id,'semester'=>$semester]) }}">Back</x-button>
                    Personal Details
                </x-slot>
                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="name" :value="__('Name')" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="father" value="Father's name" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="father" name="father" type="text" class="form-control" :value="old('father')" autocomplete="father" />
                        <x-input-error class="mt-2" :messages="$errors->get('father')" />
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="dob" :value="__('Date of birth')" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="dob" name="dob" type="date" class="form-control" :value="old('dob')" autocomplete="dob" />
                        <x-input-error class="mt-2" :messages="$errors->get('dob')" />  
                    </div>  
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="email" :value="__('Email')" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="email" name="email" type="email" class="form-control" :value="old('email')" autocomplete="email" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />    
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="phone" :value="__('Phone')" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="phone" name="phone" type="text" class="form-control" :value="old('phone')" autocomplete="phone" />
                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />    
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="address" :value="__('Address')" />
                    </div>
                    <div class="col-md-4">
                        <textarea id="address" name="address" type="text" class="form-control" autocomplete="address"></textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>
                </div>


                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="category" :value="__('Category')" />
                    </div>
                    <div class="col-md-4">
                        <x-select name='category' class="form-control">
                            <option value="">Select Category</option>
                            <option value="General">General</option>
                            <option value="SC">SC</option>
                            <option value="ST">ST</option>
                            <option value="OBC">OBC</option>
                            <option value="EWS">EWS</option>
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('category')" />    
                    </div>
                </div>
            </x-block>



            <x-block>
                <x-slot name="heading">
                    Student's Details
                </x-slot>
                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="rollno" value="Rollno" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input name="rollno" type="text" class="form-control" autocomplete="rollno" />
                        <x-input-error class="mt-2" :messages="$errors->get('rollno')" />
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="registration" value="Registration" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input name="registration" type="text" class="form-control" autocomplete="registration"/>
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
                            <option value="Regular" {{ $semester==1?' selected ':''}}>Regular</option>
                            <option value="Lateral" {{ $semester==3?' selected ':''}}>Lateral</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('type')" />
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="batch" value="Batch" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input name="batch" type="text" class="form-control" value='{{ $sessn->start_yr }}' autocomplete="batch"/>
                        <x-input-error class="mt-2" :messages="$errors->get('batch')" />
                    </div>
                </div>

                

                <div class="form-group row pt-2">
                    <div class="col-md-3"></div>
                    <div class="col-md-4">
                        <x-button type="submit">{{ __('Submit') }}</x-button>
                    </div>
                </div>
            </x-block>
        </form>
    </x-container>
</x-layout>
