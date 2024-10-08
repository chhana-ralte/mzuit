<x-layout>
    <x-container>
        <x-block>
            <x-slot:heading>
                <x-button type="a" href="/course/{{ $course->id }}?sessn={{ $sessn->id }}&semester={{ $semester }}">Back</x-button>
                Mass assignment of subjects
            </x-slot:heading>
            @if($enrollSubjectExists)
                <form method="post" action"/mass/enrollsubject">
                    @csrf
                    <input type="hidden" name="exists" value="1">
                    <input type="hidden" name="course" value="{{ $course->id }}">
                    <input type="hidden" name="sessn" value="{{ $sessn->id }}">
                    <input type="hidden" name="semester" value="{{ $semester }}">
                    There are already existing registrations. Do you want to clear them?
                    <x-button type="submit">Clear</x-button>
                </form>
            @else
            <form method="post" action="/mass/enrollsubject">
                <input type="hidden" name="exists" value="0">
                <input type="hidden" name="course" value="{{ $course->id }}">
                <input type="hidden" name="sessn" value="{{ $sessn->id }}">
                <input type="hidden" name="semester" value="{{ $semester }}">
                @csrf
                <table class="table table-striped">
                    <tr>
                      
                        <th><input type="checkbox" id="enrollCheckall">List of students</th>
                        <th><input type="checkbox" id="subjectCheckall">List of subjects</th>
                    </tr>
                    <tr>
                        <td>
                            @foreach($enrolls as $e)
                            <input type="checkbox" class="enrolls" id="e{{ $e->id }}" name="enrolls[]" value="{{ $e->id }}">
                            <label for="e{{ $e->id }}">{{ $e->student->rollno }} : {{ $e->student->person->name }}</label><br>
                            @endforeach
                        </td>
                        <td>
                            @foreach($subjects as $s)
                            <input type="checkbox" class="subjects" id="s{{ $s->id }}" name="subjects[]" value="{{ $s->id }}">
                            <label for="s{{ $s->id }}">{{ $s->code }} : {{ $s->name }}</label><br>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <x-button type="submit">Associate</x-button>
                        </td>
                    </tr>
                </table>
            </form>
            @endif
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
    $("#subjectCheckall").click(function(){
        $("input.subjects").attr('checked',$(this).is(":checked"));
    });
});
</script>
</x-layout>