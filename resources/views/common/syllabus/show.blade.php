<x-layout>

    <x-container>
        <x-block>
            <x-slot name="heading">
                <x-button type="a" href="{{ route('course.syllabus.index',[$syllabus->course_id]) }}">Back</x-button>
                Syllabi under {{ $syllabus->course->name }}
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
            <div class="pt-2">
                @if(count($subjects)>0)
                    <table class="table table-striped">
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
                                    <td><a href="/subject/{{$sj->id}}">{{ $sj->code }}</a></td>
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
