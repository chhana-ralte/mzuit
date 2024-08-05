<x-diktei>
    <x-container>
        <x-block>
            <x-slot:heading>
                Students allotted in {{$department->name}}.
            </x-slot:heading>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Rollno etc</th>
                        <th>Department</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sl=1 ?>
                    @foreach($allots as $allot)
                        <tr>
                            <td>{{ $sl++ }}</td>
                            <td>{{ $allot->diktei->name }}</td>
                            <td>{{ $allot->diktei->rollno }}</td>
                            <td>{{ $allot->diktei->department->name }}</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-block>
    </x-container>
</x-diktei>