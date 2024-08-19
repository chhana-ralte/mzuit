<x-layout>
    <x-container>
        <x-block>
            <x-slot:heading>
                <x-button type="a" href="/user/{{ auth()->user()->id }}/attmaster">Back</x-button>
                Attendance master
            </x-slot:heading>
            <div class="pt-2">
                <form method="post" action="/user/{{ auth()->user()->id }}/attmaster">
                    <input type="hidden" name="sessn_id" value="{{ $sessn->id }}">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    @csrf
                    <div class="form-group row pt-2">
                        <div class="col-md-3">
                            <label for="subject_id">Subject</label>
                        </div>
                        <div class="col-md-4">
                            <select name="subject_id" class="form-control">
                                @foreach($subjects as $sj)
                                <option value="{{$sj->id}}">{{ $sj->code }}: {{ $sj->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row pt-2">
                        <div class="col-md-3">
                            <label for="dt">Date</label>
                        </div>
                        <div class="col-md-4">
                            <input type="date" name="dt" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row pt-2">
                        <div class="col-md-3">
                            <label for="slots">Slots</label>
                        </div>
                        <div class="col-md-4">
                            <select name="slots" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row pt-2">
                        <div class="col-md-3">
                            
                        </div>
                        <div class="col-md-4">
                            <x-button type="submit">Create</x-button>
                        </div>
                    </div>
                </form>
            </div>
        </x-block>
    </x-container>
</x-layout>
