<x-layout>
    <x-slot name="header">
        {{ __('School') }}
    </x-slot>
    <x-container>
        <x-block>
            @if(count($department)>0)
                <table class="table-hover table-auto">
                    <thead>
                        <tr>
                        <th>School Name</th><th>Department Code</th><th>Department Name</th><tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($department as $dept)
                        <tr class="bg-white-100 hover:bg-sky-700 text-white-900">
                            <td>{{ $dept->school->name }}</td>
                            <td><a  href="/deptool/{{ $dept->id }}">{{ $dept->code }}</a></td>
                            <td>{{ $dept->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                No School available
            @endif
        </x-block>
    </x-container>
</x-layout>
