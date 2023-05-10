<div class="row">

    <div class="col-12">

        <div class="form-group">
            <label>Exercícios/Aparelhos utilizados</label>
            <x-form.select name="exercices[]" multiple class="select2" :options="$exercices" :value="$class->exercicesIds" />
        </div>

        <div class="form-group">
            <label>Evolução da Aula</label>
            <x-form.textarea name="evolution" rows="3">{{ $class->evolution }}</x-form.textarea>
        </div>
        
    </div>

    <div class="col-12">
        @if(count($class->student->lastEvolutions))
        <label>Avaliações Anteriores</label>
        <hr class="mt-0 mb-2">

        <div style="max-height: 200px; overflow:auto" class="pr-3">

            <ul class="list-unstyled list-unstyled-border user-list" id="message-list">
                @foreach($class->student->lastEvolutions as $evol)
                <li class="media">
                  <img alt="image" src="{{ asset($evol->instructor->user->image) }}" class="mr-3 user-img-radious-style user-list-img">
                  <div class="media-body">
                    <div class="mt-0 font-weight-bold">{{ $evol->instructor->user->name }} em {{ date('d/m/Y', strtotime($evol->date)) }}:</div>
                    <div class="text-small">{!! $evol->evolution !!}</div>
                    <div class="text-small font-weight-bold">
                        @foreach($evol->exercices as $exercice)
                        {{ $exercice->name }} <div class="bullet"></div> 
                        @endforeach
                    </div>

                  </div>
                </li>
                @endforeach
            </ul>
            
        </div>
        @else
        {{-- <p class="text-muted">
            Ainda não existem evoluções cadastradas!
        </p> --}}
        @endif
    </div>
</div>


<script>
    if (jQuery().summernote) {
        $(".summernote").summernote({
            dialogsInBody: true,
            minHeight: 250,
            toolbar: [
                // ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                // ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                // ['table', ['table']],
                ['insert', ['picture']],
                // ['view', ['fullscreen', 'codeview', 'help']],
            ],
        });

        $('.summernote.is-invalid').next().addClass('border border-danger')
    }

</script>