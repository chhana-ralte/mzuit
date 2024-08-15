<x-layout>
    <x-container>
        <x-block>
            <x-slot name="heading">
                <x-button type="a" href="{{ route('syllabus.show',[$subject->syllabus->id]) }}">Back</x-button>
                {{ $subject->code }}: {{$subject->name}}
            </x-slot>
            <div>
                @if(count($subject->contents) > 0)
                <table class="table table-striped">
                    @foreach($subject->contents as $con)
                    <tr>
                        <th>
                            <div class="col-md-3">
                                {{$con->version}}
                            </div>
                            <div class="col-md-3">
                                <x-button type="a" href="/subjectcontent/{{$con->id}}/edit">Edit</x-button>
                                <x-button type="delete" class="delete" value="{{ $con->id }}">Delete</x-button>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                        {!! $con->content !!}
                        </td>
                    </tr>
                    @endforeach
                </table>
                @endif
                <x-button type="a" href="/subject/{{ $subject->id }}/subjectcontent/create">Add content</x-button>
                
            </div>
        </x-block>
    </x-container>
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $("meta[name='csrf-token']").attr("content")
        }
    });
    $("button.delete").click(function(){
        if(confirm("Are you sure you want to delete the content?")){
            $.ajax({
                type : "delete",
                url : "/subjectcontent/" + $(this).val(),
                success : function(data, status){
                    alert(data.message);
                    location.replace('/subject/' + data.subject_id);
                },
                error : function(){
                    alert("Error");
                }
            });
        }
    });
});
</script>
</x-layout>
