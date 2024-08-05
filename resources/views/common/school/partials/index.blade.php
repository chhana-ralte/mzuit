<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Schools in Mizoram University') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("List of Schools.") }}
        </p>
    </header>
    <div>
        @if(count($schools)>0)
    
        <table class="table-hover table-auto">
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
        <button type="button" class="bg-sky-100 hover:bg-sky-700">hover me</button>
    @else
        No School available
    @endif
    </div>
</section>
