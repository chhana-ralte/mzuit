<x-diktei>
    <x-container>
        <x-block>
            <x-slot:heading>
                Students allotted in {{$dtcourse->code}} - {{$dtcourse->title}}.
                <p>
                    <a class="btn btn-secondary" href="/diktei/allotments">Back</a>
                </p>
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
                    @foreach($dtallots as $dtallot)
                        <tr>
                            <td>{{ $sl++ }}</td>
                            <td>{{ $dtallot->diktei->name }}</td>
                            <td>{{ $dtallot->diktei->rollno }}</td>
                            <td>{{ $dtallot->diktei->department->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-block>
    </x-container>
</x-diktei>