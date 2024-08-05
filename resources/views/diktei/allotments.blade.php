<x-diktei>
    <x-container>
        <x-block>
            <x-slot:heading>
                Departmental allotment details.
            </x-slot:heading>
            <div>
                <form method="post" action="/diktei/algorithm" onsubmit="return confirm('Rerunning the algorithm will re-allot based on the predefined algorithm. Are you sure you want to run?')">
                    @csrf
                    <x-button type="submit">Rerun algorithm</x-button>
                </form>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Department</th>
                        <th>Slots</th>
                        <th>Allotted</th>
                        <th>Vacant</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sl=1 ?>
                    @foreach($departments as $dep)
                        <tr>
                            <td>{{ $sl++ }}</td>
                            <td><a href="/diktei/allotments/{{$dep->id}}">{{ $dep->name }}</td>
                            <td>{{ $dep->slot() }}</td>
                            <td>{{ $dep->allotted() }}</td>
                            <td>{{ $dep->slot()-$dep->allotted() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-block>
    </x-container>
</x-diktei>