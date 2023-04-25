@extends('template.main')

@section('content')

<x-page-title>
	<x-slot name="title"><small>Foto do Perfil </small> </x-slot>
	<x-slot name="breadcrumb">
		<x-breadcrumb-item active>Usuários</x-breadcrumb-item>
	</x-slot>
</x-page-title>

<div class="row">
	<div class="col-3">

		<x-card>

			<div class="user-item">
				<img alt="image" src="{{ asset($user->image) }}" class="img-fluid">
				<div class="user-details">
					<div class="user-cta">
						<button class="btn btn-primary " id="change-avatar">
							Trocar Foto
						</button>
					</div>
				</div>
			</div>

			<form name="form-avatar" method="post" action="{{ route('avatar.store', $user) }}"
				enctype="multipart/form-data">
				@csrf
				<input type="file" name="avatar" id="" class="d-none">
				<input type="hidden" name="back" value="{{ old('back', url()->previous()) }}">
			</form>

			<x-slot name="footer">
				<a name="" id="" class="btn btn-light text-dark" href="{{ url(Request::get('to')) }}" role="button">
					<i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
					Voltar
				</a>
			</x-slot>

		</x-card>
	</div>
</div>



@endsection

@section('scripts')
<script>
	$('[name="avatar"]').change(function (e) { 
		e.preventDefault();
		$('[name="form-avatar"]').submit()
	});

	$('#change-avatar').click(function() {
		$('[name="avatar"]').trigger('click');
	});

</script>
@endsection