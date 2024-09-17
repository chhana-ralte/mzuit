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
                        <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name', $person->name)" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="father" value="Father's name" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="father" name="father" type="text" class="form-control" :value="old('father', $person->father)" autocomplete="father" />
                        <x-input-error class="mt-2" :messages="$errors->get('father')" />
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="dob" :value="__('Date of birth')" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="dob" name="dob" type="date" class="form-control" :value="old('dob', $person->dob)" autocomplete="dob" />
                        <x-input-error class="mt-2" :messages="$errors->get('dob')" />  
                    </div>  
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="gender" :value="__('Gender')" />
                    </div>
                    <div class="col-md-4">
                        <x-select name='gender' class="form-control">
                            <option value="" {{$person->gender==""?' selected ':''}}>Select Gender</option>
                            <option value="M" {{$person->gender=="M"?' selected ':''}}>Male</option>
                            <option value="F" {{$person->gender=="F"?' selected ':''}}>Female</option>
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('gender')" />    
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="email" :value="__('Email')" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="email" name="email" type="email" class="form-control" :value="old('email', $email?$email->email:'')" autocomplete="email" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />    
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="phone" :value="__('Phone')" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="phone" name="phone" type="text" class="form-control" :value="old('phone', $phone?$phone->phone:'')" autocomplete="phone" />
                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />    
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="address" :value="__('Address')" />
                    </div>
                    <div class="col-md-4">
                        <textarea id="address" name="address" type="text" class="form-control" autocomplete="address">{{ $address?$address->address:'' }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="category" :value="__('Category')" />
                    </div>
                    <div class="col-md-4">
                        <x-select name='category' class="form-control">
                            <option value="" {{$person->category==""?' selected ':''}}>Select Category</option>
                            <option value="General" {{$person->category=="General"?' selected ':''}}>General</option>
                            <option value="SC" {{$person->category=="SC"?' selected ':''}}>SC</option>
                            <option value="ST" {{$person->category=="ST"?' selected ':''}}>ST</option>
                            <option value="OBC" {{$person->category=="OBC"?' selected ':''}}>OBC</option>
                            <option value="EWS" {{$person->category=="EWS"?' selected ':''}}>EWS</option>
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('category')" />    
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        
                    </div>
                    <div class="col-md-4">
                        <x-button type="a" href="{{ route('enroll.show',[$enroll->id]) }}">Cancel</x-button>
                        <x-button type="submit" form="personal">{{ __('Save') }}</x-button>
                    </div>
                </div>
            </form>

        </x-block>
    </x-container>
</x-layout>
