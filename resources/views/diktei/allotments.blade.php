<x-diktei>
    <x-container>
        <x-block>
            <x-slot name="heading">
                Allotments in Courses
            </x-slot>
            <div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Department</th>
                            <th>Course code</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Total seat</th>
                            <th>Filled</th>
                            <th>Available</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sl=1 ?>
                        @foreach($dtcourses as $c)
                            <tr>
                                <td>{{ $sl++ }}</td>
                                <td>{{ $c->department->name }}</td>
                                <td><a href="/diktei/allotments/{{$c->id}}">{{ $c->code }}</td>
                                <td>{{ $c->title }}</td>
                                <td>{{ $c->type() }}</td>
                                <td>{{ $c->intake }}</td>
                                <td>{{ $c->filled() }}</td>
                                <td>{{ $c->vacant() }}</td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-block>
    </x-container>
</x-diktei>