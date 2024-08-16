<x-layout>

    <x-container>
        <x-block>
            <x-slot name="heading">
                <x-button type="a" href="{{ route('school.show',[$department->school->id]) }}">Back</x-button>
                Courses under {{ $department->name }}
            </x-slot>
            @if(count($department->courses)>0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th>Department Name</th><th>Course Code</th><th>Course Name</th><th>Max sem</th><tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($department->courses as $c)
                        <tr class="bg-white-100 hover:bg-sky-700 text-white-900">
                            <td>{{ $c->department->name }}</td>
                            <td><a  href="/course/{{ $c->id }}">{{ $c->code }}</a></td>
                            <td>{{ $c->name }}</td>
                            <td>{{ $c->max_sem }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                No School available
            @endif
        </x-block>
        
        <x-block>
            <x-slot name="heading">
                Teachers in the department 
                <x-button type="a" href="/department/{{$department->id}}/teacher">Manage</x-button>
            </x-slot>
            <div class="pt-2">
                @if(count($department->teachers)>0)
                <table class="table table-striped">
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Designation</th>
                    </tr>
                    <?php $sl=1 ?>
                    @foreach($department->teachers as $t)
                    <tr>
                        <td>{{ $sl++ }}</td>
                        <td>{{ $t->person->name }}</td>
                        <td>{{ $t->designation }}</td>
                    </tr>
                    @endforeach
                </table>
                @else
                No teacher in the department
                @endif
            </div>
        </x-block>
    </x-container>
</x-layout>
