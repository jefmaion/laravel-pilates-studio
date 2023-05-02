<div class="row">
    <div class="col">
        
        
        <div class="col-12 form-group">
            <label>Exercícios/Aparelhos utilizados</label>
            <x-form.select name="exercices[]" multiple class="select2" :options="$exercices" :value="$class->exercicesIds" />
        </div>
        
        
        <div class="col form-group">
            <label>Evolução da Aula</label>
            <x-form.textarea class="summernote" name="evolution" rows="10">{{ $class->evolution }}</x-form.textarea>
        </div>
    

    </div>
    <div class="col form-group">
        <label>Avaliações Anteriores</label>
        <hr class="mt-0 mb-2">
        
        @if(count($class->student->lastEvolutions))
        <div style="max-height: 400px; overflow:auto" class="pr-3">


            
            <ul class="list-unstyled list-unstyled-border list-unstyled-noborder">
                @foreach($class->student->lastEvolutions as $evol)

                <li class="media">
                    <img alt="image" class="mr-3 rounded-circle" width="40" src="{{ asset($evol->instructor->user->image) }}">
                    <div class="media-body">
                        <div class="media-right">
                            <div class="text-primary">Approved</div>
                        </div>
                        <div class="media-title mb-1">
                            <b>Aula: </b>{{ date('d/m/Y', strtotime($evol->date)) }} <div class="bullet"></div>
                            <b>Professor: </b> {{ $evol->instructor->user->name }}
                        </div>
                        <div class="text-time">
                            @foreach($evol->exercices as $exercice)
                            {{ $exercice->name }} <div class="bullet"></div>
                            @endforeach
                        </div>
                        <div class="media-description text-muted">{!! $evol->evolution !!}</div>
                    </div>
                </li>


                @endforeach
            </ul>
            </div>
        
        @else

        <p class="text-muted">
            Ainda não existem evoluções cadastradas!
        </p>

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