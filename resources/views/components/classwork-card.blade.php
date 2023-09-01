<div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapse{{ $classworkItem->id }}" aria-expanded="true"
            aria-controls="collapseOne">
            {{ $classworkItem->title }}
        </button>
    </h2>
    <div id="collapse{{ $classworkItem->id }}" class="accordion-collapse collapse show"
        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <strong> {{ $classworkItem->description }}</strong>
            <br>
            {{-- start component statistics-about-classwork --}}
        <x-statistics-about-classwork id="{{$classworkItem->id}}"/>
            {{-- end component statistics-about-classwork --}}

        </div>
        <a class="btn btn-primary"
            href="{{ route('classrooms.classworks.show', [$classworkItem->classroom, $classworkItem]) }}">عرض</a>
    </div>
</div>