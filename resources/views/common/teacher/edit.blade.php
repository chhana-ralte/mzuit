<x-layout>
    <x-container>
        <form method="post" action="{{ route('teacher.update',$teacher->id) }}" class="mt-6 space-y-6">
            @csrf
            @method('PUT')
            
            
            <x-block class="col-md-4">
                <x-slot name="heading">
                    <x-button type="a" href="{{ route('department.teacher.index',$teacher->department->id) }}">Back</x-button>
                    Personal Details
                </x-slot>
                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="name" :value="__('Name')" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="name" name="name" type="text" class="form-control" value="{{$teacher->person->name}}" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="father" value="Father's name" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="father" name="father" type="text" class="form-control" value="{{$teacher->person->father}}" autocomplete="father" />
                        <x-input-error class="mt-2" :messages="$errors->get('father')" />
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="dob" :value="__('Date of birth')" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="dob" name="dob" type="date" class="form-control" value="{{$teacher->person->dob}}" autocomplete="dob" />
                        <x-input-error class="mt-2" :messages="$errors->get('dob')" />  
                    </div>  
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="email" :value="__('Email')" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="email" name="email" type="email" class="form-control" value="{{$email}}" autocomplete="email" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />    
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="phone" :value="__('Phone')" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="phone" name="phone" type="text" class="form-control" value="{{$phone}}" autocomplete="phone" />
                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />    
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="address" :value="__('Address')" />
                    </div>
                    <div class="col-md-4">
                        <textarea id="address" name="address" type="text" class="form-control" autocomplete="address">{{$address}}</textarea>
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
                            <option value="General" {{$teacher->person->category=="General"?' selected ':''}}>General</option>
                            <option value="SC" {{$teacher->person->category=="SC"?' selected ':''}}>SC</option>
                            <option value="ST" {{$teacher->person->category=="ST"?' selected ':''}}>ST</option>
                            <option value="OBC" {{$teacher->person->category=="OBC"?' selected ':''}}>OBC</option>
                            <option value="EWS" {{$teacher->person->category=="EWS"?' selected ':''}}>EWS</option>
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
                        <x-input-label for="idcard" value="Teacher's ID" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input name="idcard" type="text" class="form-control" value="{{$teacher->idcard}}" autocomplete="idcard" />
                        <x-input-error class="mt-2" :messages="$errors->get('idcard')" />
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="department" value="Department" />
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="department">
                            @foreach(\App\Models\Department::orderBy('name')->get() as $dept)
                            <option value="{{ $dept->id }}" {{$dept->id==$teacher->department->id?' selected ':''}}>{{ $dept->name }}</option>
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
                            <option value="Professor" {{$teacher->designation=="Professor"?' selected ':''}}>Professor</option>
                            <option value="Asso. Professor" {{$teacher->designation=="Asso. Professor"?' selected ':''}}>Asso. Professor</option>
                            <option value="Asst. Professor" {{$teacher->designation=="Asst. Professor"?' selected ':''}}>Asst. Professor</option>
                            <option value="Guest Faculty" {{$teacher->designation=="guest Faculty"?' selected ':''}}>Guest Faculty</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('designation')" />
                    </div>
                </div>


                <div class="form-group row pt-2">
                    <div class="col-md-3"></div>
                    <div class="col-md-4">
                        <x-button type="submit">{{ __('Update') }}</x-button>
                    </div>
                </div>
            </x-block>
        </form>
    </x-container>
</x-layout>
