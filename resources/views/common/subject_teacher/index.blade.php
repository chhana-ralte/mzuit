<x-layout>
    <x-container>
        <x-block>
            <x-slot:heading>
                Courses that are being offered 
            </x-slot:heading>
            <table class="table table-striped pt-2">
                <tr>
                    
                    <th>Code</th>
                    <th>Name</th>
                    <th>Teacher</th>
                </tr>
                <tr>
                    <td>{{ $subject->code }}</td>
                    <td>{{ $subject->name }} </td>
                    <td>
                        
                        @foreach($subject_teachers as $st)
                        <div>
                        <button class="btn btn-danger btn-sm btn-delete" value='{{$st->id}}'>X</button>
                            {{ $st->teacher->person->name }} 
                        </div>
                        @endforeach
                        
                        <x-button type="a" href="/subject_teacher/{{ $subject->id }}/{{ $sessn->id }}/create">Add Teacher</x-button>
                    </td>
                </tr>
            </table>
            <form method='post' id="delete-form">
                @csrf
                @method('delete')
                <input type="hidden" name="subject" value="{{$subject->id}}">
                <input type="hidden" name="teacher">
            </form>
        </x-block>
    </x-container>
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("button.btn-delete").click(function(){
        //alert("hhehe");
        $("#delete-form").attr('action',"/subject_teacher/" + $(this).val());
        $("input[name='subject_teacher']").val($(this).val());
        $("#delete-form").submit();
    });
});
</script>
</x-layout>