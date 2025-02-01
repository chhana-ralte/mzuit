<x-diktei>
    <x-container>
        <x-block>
            <x-slot name="heading">
                Student's Details
            </x-slot>
            <form method="post" action="/diktei/store">
                @csrf
                <div class="form-group row p-2">
                    <div class="col-md-3">
                        <x-input-label for="name" value="Enter Name"/>
                    </div>
                    <div class="col-md-4">
                        <x-text-input name="name" type="text" class="form-control" value="{{ old('name') }}" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                </div>
                <div class="form-group row p-2">
                    <div class="col-md-3">
                        <x-input-label for="name" value="Enter Roll no" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="rollno" name="rollno" type="text" class="form-control" value="{{ old('rollno') }}" required autocomplete="rollno" />
                        <x-input-error class="mt-2" :messages="$errors->get('rollno')" />
                    </div>
                </div>
                <div class="form-group row p-2">
                    <div class="col-md-3">
                        <x-input-label for="department" value="Select the department" />
                    </div>
                    <div class="col-md-4">
                        <x-select name="department" class="form-control">
                            <?php
                            if(old('department')){
                                $did = old('department');
                                echo "<option>Dummy</option>";
                            }
                            else if(isset($department)){
                                $did = $department->id;
                                echo "<option>Dummy2</option>";
                            }
                            else{
                                $did = 0;
                                echo "<option>Dummy3</option>";
                            }
                            ?>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" {{ $did==$dept->id?' selected ':''}}>{{ $dept->name }}</option>
                        @endforeach
                        </x-select>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('department')" />
                </div>
                <div  class="form-group row p-3">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-4">
                        <x-button type="submit">{{ __('Submit') }}</x-button>
                    </div>
                </div>
            </form>
        </x-block>
    </x-container>
</x-diktei>