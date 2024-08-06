<x-layout>
    <x-slot name="header">
        {{ __('School') }}
    </x-slot>
    <x-container>
        <x-block>
            @if(count($schools)>0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>School Code</th><th>School Name</th><tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schools as $sch)
                        <tr class="bg-white-100 hover:bg-sky-700 text-white-900">
                            <td><a  href="/school/{{ $sch->id }}">{{ $sch->code }}</a></td>
                            <td>{{ $sch->name }}</td>
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
