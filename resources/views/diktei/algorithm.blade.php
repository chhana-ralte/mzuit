<x-diktei>
    <x-container>
        <x-block>
            <x-slot name="heading">
                Running algorithm
            </x-slot>
            <p>
                Running the algorithm will erase all allotments made, and it will be executed from the seniority of submission of options in the portal.
            </p>
            <form method="POST" action="/diktei/algorithm">
                @csrf
                <button type="submit" class="btn btn-primary">Run Algorithm</button>
            </form>
        </x-block>
    </x-container>
</x-diktei>
