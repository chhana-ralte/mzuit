<x-layout>
    <x-container>
        <x-block>
            <x-slot name="heading">
                <x-button type="a" href="{{ route('course.show',[$course->id]) }}">Back</x-button>
                List of Syllabi under {{ $course->name }}
                <x-button type="a" href="/course/{{$course->id}}/syllabus/create">New syllabus</x-button>
            </x-slot>
            <table class="table table-striped">
                <tr>
                    <th>Syllabus name</th>
                    <th>Year range for batches</th>
                    <th>Edit|Delete</th>
                </tr>
                @foreach($course->syllabi as $syl)
                    <tr>
                        <td><a href="{{ route('syllabus.show',$syl->id) }}">{{ $syl->name }}</a></td>
                        <td>{{ $syl->from_batch }} - {{ $syl->to_batch }}</td>
                        <td>
                            <div class="btn-group">
                                <x-button type="a" href="/syllabus/{{$syl->id}}/edit">Edit</x-button>
                                <x-button type="delete" class="delete" value="{{$syl->id}}">Delete</x-button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
            <form id="form-delete" method="post" action="">
                <input type="hidden" name="syllabus">
                @csrf
                @method("delete")
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
    
    $("button.delete").click(function(){
        //alert($(this).val());
        if(confirm("Are you sure?")){
            $("form#form-delete").attr("action","/syllabus/" + $(this).val());
            $("input[name='syllabus']").val($(this).val());
            $("form#form-delete").submit();
        }
    });
});

</script>
</x-layout>
