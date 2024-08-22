<x-layout>
    <x-container>
        <x-block>
            <x-slot:heading>
                <x-button type="a" href="{{ route('sessn.show',$sessn->id)}}">Back</x-button>
                Subject teachers
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
                        <form>
                            <input type="text" class="form-control" id="search">
                        </form>
                        <form method="post" action="/subject_teacher/{{ $subject->id }}/{{ $sessn->id }}">
                            @csrf
                            <div id="results" class="pt-2">
                            </div>
                            <x-button type="submit" id="submit">Add teacher</x-button>
                        </form>
                        <!-- <x-button type="a" href="/subject_teacher/{{ $subject->id }}/{{ $sessn->id }}/create">Add Teacher</x-button> -->
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
    $('input#search').keyup(function(){
        //alert($(this).val());
        $.ajax({
            url : '/subject_teacher/searchresults?search=' + $(this).val(),
            type : 'get',
            
            success : function(data, status){
                var str="<table class='table table-striped'>";
                for(i=0;i<data.length;i++){
                    str += "<tr>";
                    str += "<td><input type='checkbox' name='teachers[]' value='" + data[i].id + "'></td>";
                    str += "<td>" + data[i].name + "</td>";
                    str += "<td>" + data[i].department + "</td>";
                    str += "</tr>";
                }
                str += "</table>";
                $('div#results').html(str);
            },
            error : function(){
                alert("Error");
            }
        })
    });
});
</script>
</x-layout>