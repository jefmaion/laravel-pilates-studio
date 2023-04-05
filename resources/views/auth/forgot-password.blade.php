@extends('template.auth')

@section('content')
<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
	<div class="card card-primary">
		<div class="card-header">
			<h4>Esqueci a Senha</h4>
		</div>
		<div class="card-body">
			<p class="text-muted">Vamos enviar um link para resetar a sua senha!</p>
			<form method="POST" action="{{ route('password.email') }}">
				@csrf
				<div class="form-group">
					<label for="email">Email</label>
					<input id="email" type="email" class="form-control" name="email" tabindex="1"
						value="{{ old('email') }}" required autofocus autofocus>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
						Resetar Senha
					</button>
				</div>
			</form>

			<!-- Session Status -->
			<x-auth-session-status class="mb-4" :status="session('status')" />

			<!-- Validation Errors -->
			<x-auth-validation-errors class="mb-4 alert alert-danger" :errors="$errors" />

		</div>
	</div>
</div>
@endsection
