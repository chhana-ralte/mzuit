<x-layout>
    <x-slot name="header">
    <x-button type="a" href="{{ route('course.show',[$syllabus->course_id]) }}">Back</x-button>
        {{ __('Syllabi') }}
    </x-slot>
    <x-container>
        <x-block>
            <x-slot name="block_header">
                List of Subjects under Syllabus {{ $syllabus->name }}
            </x-slot>
            <div>
                @foreach($syllabus->course->syllabi as $syl)
                    @if($syllabus->id == $syl->id)
                        <x-button :selected=true type="a" href="{{ route('syllabus.show',[$syl->id]) }}">{{$syl->name}}</a></x-button>
                    @else
                    <x-button :selected=false type="a" href="{{ route('syllabus.show',[$syl->id]) }}">{{$syl->name}}</a></x-button>
                    @endif
                @endforeach
            </div>
            <div>
                @if(count($subjects)>0)
                    <table class="table-fixed">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Code</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sl=1 ?>
                            @foreach($subjects as $sj)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $sj->code }}</td>
                                    <td>{{ $sj->name }}</td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                @endif
            </div>
        </x-block>
    </x-container>
</x-layout>
