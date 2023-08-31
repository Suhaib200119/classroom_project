<div class="row" style="width: 50%;margin: 0px 25% 0% 25%;text-align: center">
    <div class="col">
       
        <h2>
            {{ $classwork->users()->whereNotNull('grade')->count() }}
        </h2>
        Graded

    </div>
    <div class="col">

        <h2>
            {{ $classwork->users()->where('status', '=', 'submitted')->count() }}

        </h2>
        Submitted
    </div>
    <div class="col">
        <h2>
            {{ $classwork->users()->where('status', '=', 'assigned')->count() }}

        </h2>
        Assigned

    </div>
</div>