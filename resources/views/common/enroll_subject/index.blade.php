<x-layout>
    <x-container>
        <x-block>
            <x-slot name="heading">
                <x-button type="a" href="{{ route('course.show',[$course->id,'semester'=>$semester,'sessn'=>$sessn->id]) }}">Back</x-button>
                List of subjects taken by students of {{$course->name}}
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
                            <x-button :selected=true type="a" href="{{ route('enroll_subject.index',['course'=>$course->id,'semester'=>$sem,'sessn'=>$sessn->id]) }}">{{$sem}}</a></x-button>
                        @else
                            <x-button type="a" href="{{ route('enroll_subject.index',['course'=>$course->id,'semester'=>$sem,'sessn'=>$sessn->id]) }}">{{$sem}}</a></x-button>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="pt-2">
                @if(count($enrolls)>0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Roll no</th>
                                <th>Name</th>
                                @foreach($subjects as $sj)
                                    <th>{{$sj->code}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sl=1 ?>
                            @foreach($enrolls as $e)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td><a href="{{ route('enroll_subject.show',$e->id) }}">{{ $e->student->rollno }}</td>
                                    <td>{{ $e->student->person->name }}</td>
                                    @foreach($subjects as $sj)
                                        <td>
                                            @if(isset($enroll_subjects[$e->id][$sj->id]))
                                                {{ $enroll_subjects[$e->id][$sj->id]}}
                                            @else
                                                <font color="red">X</font>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                @endif
            </div>
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
