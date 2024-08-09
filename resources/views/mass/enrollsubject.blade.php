<x-layout>
    <x-container>
        <x-block>
            <x-slot:heading>
                <x-button type="a" href="/sessn">Back</x-button>
                Mass assignment of subjects
            </x-slot:heading>
            <form method="post" action="/mass/enrollsubject">
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
                            <label for="e{{ $e->id }}">{{ $e->id }}</label><br>
                            @endforeach
                        </td>
                        <td>
                            @foreach($subjects as $s)
                            <input type="checkbox" id="s{{ $s->id }}" name="subjects[]" value="{{ $s->id }}">
                            <label for="s{{ $s->id }}">{{ $s->id }}</label><br>
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