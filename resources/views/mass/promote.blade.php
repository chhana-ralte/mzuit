<x-layout>
    <x-container>
        <x-block>
            <x-slot:heading>
                <x-button type="a" href="/course/{{ $course->id }}?sessn={{ $sessn->id }}&semester={{ $semester }}">Back</x-button>
                Mass promotion of students
            </x-slot:heading>
            <form method="post" action="/mass/promote">
                <input type="hidden" name="course" value="{{ $course->id }}">
                <input type="hidden" name="sessn" value="{{ $sessn->id }}">
                <input type="hidden" name="semester" value="{{ $semester }}">
                @csrf
                <table class="table table-striped">
                    <tr>
                        <th>
                            <input type="checkbox" id="enrollCheckall">
                            List of students
                        </th>
                    </tr>
                    <tr>
                        <td>
                            @foreach($enrolls as $e)
                            <input type="checkbox" class="enrolls" id="e{{ $e->id }}" name="enrolls[]" value="{{ $e->id }}">
                            <label for="e{{ $e->id }}">{{ $e->student->rollno }} : {{ $e->student->person->name }}</label><br>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <x-button type="submit">Promote selected</x-button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Promote them to the next semester : {{$semester+1}} in the {{ $sessn->nextSessn()->name() }}
                        </td>
                    </tr>
                </table>
            </form>
        </x-block>
    </x-container>
    <script>
$(document).ready(function(){
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $("meta[name='csrf-token']").attr('content')
        }
    });
    $("#enrollCheckall").click(function(){
        $("input.enrolls").attr('checked',$(this).is(":checked"));
    });
});
</script>

</x-layout>