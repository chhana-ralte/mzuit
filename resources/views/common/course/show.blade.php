<x-layout>
    <x-container>
        <x-block>
            <x-slot name="heading">
                <x-button type="a" href="{{ route('department.show',[$course->department->id]) }}">Back</x-button>
                List of {{ $course->name }} Students
            </x-slot>
            <div class="form-group row pt-2">
                <div class="col-md-3">
                    <x-select id="sessn_id" class="form-control" onchange="submit()">
                    @foreach($sessns as $ss)
                        <option value="{{ $ss->id }}" {{$ss->id==$sessn->id?' selected ':''}}>{{$ss->name()}}</option>
                    @endforeach
                    </x-select>
                </div>
                <div class="col-md-9">
                    @foreach($semesters as $sem)
                        @if($sem == $semester)
                            <x-button :selected=true type="a" href="{{ route('course.show',[$course->id,'semester'=>$sem,'sessn'=>$sessn->id]) }}">{{$sem}}</a></x-button>
                        @else
                            <x-button type="a" href="{{ route('course.show',[$course->id,'semester'=>$sem,'sessn'=>$sessn->id]) }}">{{$sem}}</a></x-button>
                        @endif
                    @endforeach
                    @if(auth()->user()->hasRole('Admin'))
                        <x-button type="a" href="/mass/enrollsubject?course={{ $course->id }}&semester={{ $semester }}&sessn={{ $sessn->id }}">Mass assign subjects</x-button>
                        @if($course->max_sem != $semester)
                            <x-button type="a" href="/mass/promote?course={{ $course->id }}&semester={{ $semester }}&sessn={{ $sessn->id }}">Mass promote</x-button>
                        @endif
                    @endif
                    <x-button type="a" href="/enroll_subject?course={{ $course->id }}&semester={{ $semester }}&sessn={{ $sessn->id }}">Enroll subjects</x-button>
                </div>
            </div>
            @if($semester <= 3)
            <div class="pt-2">
                <x-button type="a" href="/enroll/create?course={{ $course->id }}&semester={{ $semester }}&sessn={{ $sessn->id }}">Add student</x-button>
            </div>
            @endif
            <div class="pt-2">
                @if(count($enrolls)>0)
                    <table class="table table-striped">
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
            <x-slot name="heading">
                List of Syllabi
                <x-button type="a" href="/course/{{$course->id}}/syllabus">Manage</x-button>
            </x-slot>
            <table class="table table-striped">
                <tr>
                    <th>Syllabus name</th>
                    <th>Year range for batches</th>
                </tr>
                @foreach($course->syllabi as $syl)
                    <tr>
                        <td><a href="{{ route('syllabus.show',$syl->id) }}">{{ $syl->name }}</a></td>
                        <td>{{ $syl->from_batch }} - {{ $syl->to_batch }}</td>
                    </tr>
                @endforeach
            </table>
        </x-block>
    </x-container>
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("select#sessn_id").change(function(){
        location.replace('/course/{{ $course->id }}?sessn=' + $(this).val());
        //alert('chaged' + $(this).val());
    });
    $("button[name='delete']").click(function(){
        //alert($(this).attr('id'));
        if(confirm("I delete duh tak tak em?")){
            $.ajax({
                url : "/user/" + $(this).attr('id'),
                type : "delete",
                data : {
                    user_id : $(this).attr('id'),
                },
                success : function(data,status){
                    alert(data);
                    location.replace("/user");
                },
                error : function(){
                    alert("error");
                }
            })
        }
    });
});

</script>
</x-layout>
