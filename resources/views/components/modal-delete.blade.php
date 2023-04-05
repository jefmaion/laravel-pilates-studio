@section('body')
<div class="modal fade show" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            {{-- <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Excluir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div> --}}
            <div class="modal-body text-center p-4 mt-4">

                {{-- <i class="fas fa-trash-alt text-danger" style="font-size: 4em !important"></i> --}}
                <i class="far fa-times-circle  text-danger  " style="font-size: 7em !important"></i>

                <h3 class="font-weight-light p-4">Você tem certeza?</h3>

                <h5 class="font-weight-light">Deseja realmente excluir esse registro?</h5>
            </div>
            <div class="modal-footer bg-whitesmoke br">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times-circle    "></i>
                    Cancelar
                </button>

                <form action="" method="post"></form>
                <button type="button" class="btn btn-danger">
                    <i class="fas fa-trash-alt"></i>
                    Excluir
                </button>
                
            </div>
        </div>
    </div>
</div>
@endsection