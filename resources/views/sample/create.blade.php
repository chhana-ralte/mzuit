<x-layout>
    <x-container>
        <x-block>
            <x-slot:heading>
                Create creation form
            </x-slot:heading>
            <form>
                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        Course Name
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="name">
                    </div>
                </div>


                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        Course Duration
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="name">
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        Course Incharge
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="name">
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                     
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </x-block>
    </x-container>
</x-layout>
