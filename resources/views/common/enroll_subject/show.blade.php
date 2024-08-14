<x-layout>
    <x-container>
        <x-block>
            <x-slot name="heading">
                <x-button type="a" href="{{ route('enroll_subject.index',['course'=>$enroll->course->id,'semester'=>$enroll->semester,'sessn'=>$enroll->sessn->id]) }}">Back</x-button>
                List of subjects by {{ $enroll->student->rollno }}
            </x-slot>
            <div class="pt-2">
                <table class="table table-striped">
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Remove</th>
                    </tr>
                    @foreach($enroll->subjects as $sj)
                        <tr>
                            <td>{{ $sj->code }}</td>
                            <td>{{ $sj->name }}</td>
                            <td><button class="btn btn-danger btn-remove" value="{{$sj->id}}">Remove</td>
                        </tr>
                    @endforeach
                </table>
                <form method="post" id="form-remove" action="/enroll_subject/{{$enroll->id}}">
                    <input type="hidden" name="subject">
                    @csrf
                    @method('delete')
                </form>
            </div>
        </x-block>
        @if(count($nosubjects)>0)
            <x-block>
                <x-slot:heading>
                    List of subjects not selected
                </x-slot:heading>
                <div class="pt-2">
                    <table class="table table-striped">
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Add</th>
                        </tr>
                        @foreach($nosubjects as $sj)
                            <tr>
                                <td>{{ $sj->code }}</td>
                                <td>{{ $sj->name }}</td>
                                <td><button class="btn btn-primary btn-add" value="{{$sj->id}}">Add</td>
                            </tr>
                        @endforeach
                    </table>
                    <form method="post" id="form-add" action="/enroll_subject/{{$enroll->id}}">
                        <input type="hidden" name="subject">
                        @csrf
                    </form>
                </div>
            </x-block>
        @endif
    </x-container>
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("button.btn-remove").click(function(){
        //alert($(this).val());
        $("input[name='subject']").val($(this).val());
        $("form#form-remove").submit();
        
    });
    $("button.btn-add").click(function(){
        //alert($(this).val());
        $("input[name='subject']").val($(this).val());
        $("form#form-add").submit();
        
    });
});

</script>
</x-layout>
