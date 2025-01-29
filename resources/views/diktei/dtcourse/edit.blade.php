<x-diktei>
    <x-container>
        <x-block>
            <x-slot name="heading">
                New entry of interdisciplinary courses
            </x-slot>
            <form method="post" action="{{ route('dtcourse.update',$dtcourse->id) }}">
                <input type="hidden" name="id" value="{{$dtcourse->id}}">
                @csrf
                @method('patch')
                <div class="form-group row p-2">
                    <div class="col-md-3">
                        <x-input-label for="department" value="Select the department" />
                    </div>
                    <div class="col-md-4">
                        <x-select name="department" class="form-control">
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" {{$dtcourse->department->id == $dept->id?" selected ":""}}>{{ $dept->name }}</option>
                        @endforeach
                        </x-select>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('department')" />
                </div>

                <div class="form-group row p-2">
                    <div class="col-md-3">
                        <x-input-label for="code" value="Enter course code"/>
                    </div>
                    <div class="col-md-4">
                        <x-text-input name="code" type="text" class="form-control" value="{{ $dtcourse->code }}" required autofocus autocomplete="code" />
                        <x-input-error class="mt-2" :messages="$errors->get('code')" />
                    </div>
                </div>

                <div class="form-group row p-2">
                    <div class="col-md-3">
                        <x-input-label for="title" value="Enter the title" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="title" name="title" type="text" class="form-control" value="{{ $dtcourse->title }}" required autocomplete="title" />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>
                </div>
                
                <div class="form-group row p-2">
                    <div class="col-md-3">
                        <x-input-label for="major" value="Select the type" />
                    </div>
                    <div class="col-md-4">
                        <x-select name="major" class="form-control">
                            <option value="1" {{ $dtcourse->major?" selected ":"" }}>IMJ</option>
                            <option value="0"  {{ $dtcourse->major==0?" selected ":"" }}>IMN</option>
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('major')" />
                    </div>
                </div>

                <div class="form-group row p-2">
                    <div class="col-md-3">
                        <x-input-label for="credit" value="Select credit" />
                    </div>
                    <div class="col-md-4">
                        <x-select name="credit" class="form-control">
                            <option value="2"  {{ $dtcourse->credit==2?" selected ":"" }}>2</option>
                            <option value="3"  {{ $dtcourse->credit==3?" selected ":"" }}>3</option>
                            <option value="4"  {{ $dtcourse->credit==4?" selected ":"" }}>4</option>
                            <option value="5"  {{ $dtcourse->credit==5?" selected ":"" }}>5</option>
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('credit')" />
                    </div>
                </div>

                <div class="form-group row p-2">
                    <div class="col-md-3">
                        <x-input-label for="intake" value="Enter the intake" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="intake" name="intake" type="text" class="form-control" value="{{ $dtcourse->intake }}" required autocomplete="intake" />
                        <x-input-error class="mt-2" :messages="$errors->get('intake')" />
                    </div>
                </div>
                
                <div class="form-group row p-2">
                    <div class="col-md-3">
                        <x-input-label for="faculty" value="Enter the name of faculty" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="faculty" name="faculty" type="text" class="form-control" value="{{ $dtcourse->faculty }}" autocomplete="faculty" />
                        <x-input-error class="mt-2" :messages="$errors->get('faculty')" />
                    </div>
                </div>
                
                <div class="form-group row p-2">
                    <div class="col-md-3">
                        <x-input-label for="contact" value="Enter the contact" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="contact" name="contact" type="text" class="form-control" value="{{ $dtcourse->contact }}" autocomplete="contact" />
                        <x-input-error class="mt-2" :messages="$errors->get('contact')" />
                    </div>
                </div>

                
                <div  class="form-group row p-3">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-4">
                        <a href="/dtcourse/{{$dtcourse->id}}" class="btn btn-secondary">Back</a>
                        <x-button type="submit">{{ __('Update') }}</x-button>
                    </div>
                </div>
            </form>
        </x-block>
    </x-container>
</x-diktei>