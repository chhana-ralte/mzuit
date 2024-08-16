<x-layout>
    <x-container>
        <x-block>
            <x-slot name="heading">
                <x-button type="a" href="{{ route('course.show',[$course->id]) }}">Back</x-button>
                New syllabus creation under {{$course->name}}
            </x-slot>
            <form method="post" action="/course/{{$course->id}}/syllabus">
                @csrf
                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <label for="name">Syllabus name/year</label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="name" class="form-control" :value="old('name')" required>
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <label for="from_batch">From batch</label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="from_batch" class="form-control" :value="old('from_batch')" required>
                        <x-input-error class="mt-2" :messages="$errors->get('from_batch')" />
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <label for="to_batch">To batch</label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="to_batch" class="form-control" :value="old('to_batch')" required>
                        <x-input-error class="mt-2" :messages="$errors->get('to_batch')" />

                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
            
        </x-block>
    </x-container>
</x-layout>
