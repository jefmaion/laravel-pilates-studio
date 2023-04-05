@extends('template.auth')


@section('content')

<link rel="stylesheet" href="{{ asset('template/assets/bundles/jquery-selectric/selectric.css') }}">

<div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
	<div class="card card-primary">
		<div class="card-header">
			<h4>Registre-se</h4>
		</div>
		<div class="card-body">
			<form method="POST" action="{{ route('register') }}">
				@csrf
				<div class="row">
					<div class="form-group col-12">
						<label for="frist_name">Nome</label>
						<input id="frist_name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>
					</div>
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
					<div class="invalid-feedback">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-6">
						<label for="password" class="d-block">Senha</label>
						<input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" required autocomplete="new-password">
						<div id="pwindicator" class="pwindicator">
							<div class="bar"></div>
							<div class="label"></div>
						</div>
					</div>
					<div class="form-group col-6">
						<label for="password2" class="d-block">Repetir Senha</label>
						<input id="password2" type="password" class="form-control" name="password_confirmation"
							required>
					</div>
				</div>
				<div class="form-group">
					<div class="custom-control custom-checkbox">
						<input type="checkbox" name="agree" class="custom-control-input" id="agree">
						<label class="custom-control-label" for="agree">Eu aceito os termos e condições</label>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-lg btn-block">
						Registrar
					</button>
				</div>
			</form>

			<!-- Validation Errors -->
			<x-auth-validation-errors class="mb-4" :errors="$errors" />

		</div>
		<div class="mb-4 text-muted text-center">
			Ja está registrado? <a href="{{ route('login') }}">Faça o Login</a>
		</div>
	</div>
</div>
@endsection

@section('auth.scripts')
<script src="{{ asset('template/assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
<script src="{{ asset('template/assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('template/assets/js/page/auth-register.js') }}"></script>
@endsection