<x-layout>
    <x-container>
        <x-block>
            <x-slot:heading>
                <x-button type="a" href="/sessn">Back</x-button>
                New Session
            </x-slot:heading>
            <form method="post" action="/sessn">
                @csrf
                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <label for="start_yr">Starting year</label>
                    </div>
                    <div class="col-md-3">
                        <select name="start_yr" class="form-control">
                            <option value="2024">2024-25</option>
                            <option value="2025">2025-26</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <label for="odd_even">Even-Odd</label>
                    </div>
                    <div class="col-md-3">
                        <select name="odd_even" class="form-control">
                            <option value="1">Odd</option>
                            <option value="1">Even</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <x-button type="submit">Submit</x-button>
                    </div>
                </div>
            </form>
        </x-block>
    </x-container>
</x-layout>