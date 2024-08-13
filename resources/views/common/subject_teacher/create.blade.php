<x-layout>
    <x-container>
        <x-block>
            <x-slot:heading>
                Add teacher to {{ $subject->code }}: {{ $subject->name }}
            </x-slot:heading>
            <form>
                <input type="text" class="form-control" id="search">
            </form>
            <form method="post" action="/subject_teacher/{{ $subject->id }}/{{ $sessn->id }}">
                @csrf
                <div id="results" class="pt-2">
                </div>
                <x-button type="submit" id="submit">Add teacher</x-button>
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