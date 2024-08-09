<x-layout>
    <x-slot name="heading">
        
        {{ $enroll->student->person->name }}
        <x-button type="a" href="{{ route('enroll.edit', $enroll->id) }}">Edit</x-button>
    </x-slot>
    <x-container>
        <x-block class="col-md-4">
            <x-slot name="heading">
                <x-button type="a" href="{{ route('course.show',[$enroll->course_id,'sessn'=>$enroll->sessn_id,'semester'=>$enroll->semester]) }}">Back</x-button>
                Personal Details
            </x-slot>
            
            <table class="table table-striped">
                <tr>
                    <td><strong>Name</strong></td>
                    <td>{{ $enroll->student->person->name }}</td>
                </tr>
                <tr>
                    <td><strong>Father's name</strong></th>
                    <td>{{ $enroll->student->person->father }}</td>
                </tr>
                <tr>
                    <td><strong>Date of Birth</strong></th>
                    <td>{{ $enroll->student->person->dob }}</td>
                </tr>
            </table>
        </x-block>
        <x-block>
            <x-slot name="heading">
                Student's Details
            </x-slot>
            <table class="table table-striped">
                <tr>
                    <td><strong>Rollno</strong></th>
                    <td>{{ $enroll->student->rollno }}</td>
                </tr>
                <tr>
                    <td><strong>Batch</strong></th>
                    <td>{{ $enroll->student->sessn->name() }}</td>
                </tr>
                <tr>
                    <td><strong>Type</strong></th>
                    <td>{{ $enroll->student->type }}</td>
                </tr>
                <tr>
                    <td><strong>Status</strong></th>
                    <td>{{ $enroll->student->completed?"Completed":($enroll->student->dropout?"Drop out":"Ongoing") }}</td>
                </tr>
            </table>
        </x-block>


        <x-block>
            <x-slot name="heading">
                Enrollment details
            </x-slot>
            <table class="table table-striped">
                <tr>
                    <th>Enrolment session</th>
                    <th>Semester in which enrolled</th>
                    <th>Subjects</th>
                </tr>
                @foreach($enroll->student->enrolls as $e)
                <tr>
                    <td>{{ $e->sessn->name() }}</th>
                    <td class="text-center">{{ $e->semester }}</td>
                    <td>
                        @foreach($e->subjects as $sj)
                            {{ $sj->code }} - {{$sj->name }} <br>
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </table>
        </x-block>
    </x-container>
</x-layout>
