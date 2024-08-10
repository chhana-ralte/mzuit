<x-layout>
    <x-container>
        <x-block>
            <x-slot:heading>
                <x-button type="a" href="/course/{{ $course->id }}?sessn={{ $sessn->id }}&semester={{ $semester }}">Back</x-button>
                Mass assignment of subjects
            </x-slot:heading>
            <form method="post" action="/mass/enrollsubject">
                <input type="hidden" name="course" value="{{ $course->id }}">
                <input type="hidden" name="sessn" value="{{ $sessn->id }}">
                <input type="hidden" name="semester" value="{{ $semester }}">
                @csrf
                <table class="table table-striped">
                    <tr>
                        <th>List of students</th>
                        <th>List of subjects</th>
                    </tr>
                    <tr>
                        <td>
                            @foreach($enrolls as $e)
                            <input type="checkbox" id="e{{ $e->id }}" name="enrolls[]" value="{{ $e->id }}">
                            <label for="e{{ $e->id }}">{{ $e->student->rollno }} : {{ $e->student->person->name }}</label><br>
                            @endforeach
                        </td>
                        <td>
                            @foreach($subjects as $s)
                            <input type="checkbox" id="s{{ $s->id }}" name="subjects[]" value="{{ $s->id }}">
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
        </x-block>
    </x-container>
</x-layout>