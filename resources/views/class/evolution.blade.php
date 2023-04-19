<div class="col-12 form-group">
    <label>Exercícios/Aparelhos utilizados</label>
    <x-form.select name="exercices[]" multiple class="select2" :options="$exercices" :value="$class->exercicesIds" />
</div>


<div class="col form-group">
    <label>Evolução da Aula</label>
    <x-form.textarea  class="summernote" name="evolution" rows="10">{{ $class->evolution }}</x-form.textarea>
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