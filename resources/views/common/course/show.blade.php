<x-layout>
    <x-slot name="header">
    <x-button type="a" href="{{ route('department.show',[$course->department_id]) }}">Back</x-button>
        {{ $course->name }}
    </x-slot>
    <x-container>
        <x-block>
            <x-slot name="block_header">
                List of Students
            </x-slot>
            <div>
                <x-select>
                @foreach($sessns as $ss)
                    <option value="{{ $ss->id }}" {{$ss->id==$sessn->id?' selected ':''}}>{{$ss->name()}}</option>
                @endforeach
                </x-select>
                @foreach($semesters as $sem)
                    @if($sem == $semester)
                        <x-button :selected=true type="a" href="{{ route('course.show',[$course->id,'semester'=>$sem,'sessn'=>$sessn->id]) }}">{{$sem}}</a></x-button>
                    @else
                        <x-button type="a" href="{{ route('course.show',[$course->id,'semester'=>$sem,'sessn'=>$sessn->id]) }}">{{$sem}}</a></x-button>
                    @endif
                @endforeach
            </div>
            <div>
                @if(count($enrolls)>0)
                    <table class="table-fixed">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Roll no</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sl=1 ?>
                            @foreach($enrolls as $e)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td><a href="{{ route('enroll.show',$e->id) }}">{{ $e->student->rollno }}</td>
                                    <td>{{ $e->student->person->name }}</td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                @endif
            </div>
        </x-block>
        <x-block>
            <x-slot:block_header>
                List of Syllabi
            </x-slot:block_header>
            @foreach($course->syllabi as $syl)
                <div><a href="{{ route('syllabus.show',$syl->id) }}">{{ $syl->name }}</a></div>
            @endforeach
        </x-block>
    </x-container>
</x-layout>
