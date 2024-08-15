<x-layout>
    <x-container>
        <form method="post" action="{{ route('department.teacher.store',$department->id) }}" class="mt-6 space-y-6">
            @csrf
            
            
            <x-block class="col-md-4">
                <x-slot name="heading">
                    <x-button type="a" href="{{ route('department.teacher.index',$department->id) }}">Back</x-button>
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
                    Teacher's Details
                </x-slot>
                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="code" value="Teacher's Code" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input name="code" type="text" class="form-control" autocomplete="code" />
                        <x-input-error class="mt-2" :messages="$errors->get('code')" />
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="department" value="Department" />
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="department">
                            @foreach(\App\Models\Department::orderBy('name')->get() as $dept)
                            <option value="{{ $dept->id }}" {{$dept->id==$department->id?' selected ':''}}>{{ $dept->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('department')" />
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="designation" value="Designation" />
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="designation">
                            <option value="Professor">Professor</option>
                            <option value="Asso. Professor">Asso. Professor</option>
                            <option value="Asst. Professor">Asst. Professor</option>
                            <option value="Guest Faculty">Guest Faculty</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('designation')" />
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
