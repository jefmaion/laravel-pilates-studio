<div class="row">

    <div class="col">

        <div class="row">
            
            <div class="col-2 form-group">
                <label>CPF</label>
                <x-form.input name="cpf" class="cpf" value="{{ old('cpf', $user->cpf) }}" />
            </div>
        
        
            <div class="col-6 form-group">
                <label>Nome</label>
                <x-form.input name="name" value="{{ old('name', $user->name) }}" />
            </div>

            <div class="col-2 form-group">
                <label>Data de Nascimento</label>
                <x-form.input type="date" name="birth_date" value="{{ old('birth_date', $user->birth_date) }}" />
            </div>

            <div class="col-2 form-group">
                <label>Apelido</label>
                <x-form.input name="nickname" value="{{ old('nickname', $user->nickname) }}" />
            </div>
        
            
        
            <div class="col-2 form-group">
                <label>Sexo</label>
                <x-form.select name="gender" :options="['M' => 'Masculino', 'F' => 'Feminino']" value="{{ old('gender', $user->gender) }}" />
            </div>

            <div class="col-2 form-group">
                <label>Telefone (WhatsApp)</label>
                <x-form.input type="text" class="sp_celphones" name="phone_wpp"
                    value="{{ old('phone_wpp', $user->phone_wpp) }}" />
            </div>
        
            <div class="col-2 form-group">
                <label>Telefone Recado</label>
                <x-form.input type="text" class="sp_celphones" name="phone2" value="{{ old('phone2', $user->phone2) }}" />
            </div>
        
            <div class="col-6 form-group">
                <label>E-mail</label>
                <x-form.input type="email" class="viacep-loading" name="email" value="{{ old('email', $user->email) }}" />
            </div>
        
            
        </div>

        <div class="row">

    

            <div class="col-2 form-group">
                <label>CEP</label>
                <x-form.input type="text" class="cep" name="zipcode" value="{{ old('zipcode', $user->zipcode) }}" />
            </div>
        
            <div class="col-5 form-group">
                <label>Endereço</label>
                <x-form.input type="text" class="viacep-loading" name="address" value="{{ old('address', $user->address) }}" />
            </div>
        
            <div class="col-2 form-group">
                <label>Nº</label>
                <x-form.input type="text" name="number" value="{{ old('number', $user->number) }}" />
            </div>
        
            <div class="col-3 form-group">
                <label>Complemento</label>
                <x-form.input type="text" class="viacep-loading" name="complement"
                    value="{{ old('complement', $user->complement) }}" />
            </div>
        
            <div class="col-7 form-group">
                <label>Bairro</label>
                <x-form.input type="text" class="viacep-loading" name="district"
                    value="{{ old('district', $user->district) }}" />
            </div>
        
            <div class="col-3 form-group">
                <label>Cidade</label>
                <x-form.input type="text" class="viacep-loading" name="city" value="{{ old('city', $user->city) }}" />
            </div>
        
            <div class="col-2 form-group">
                <label>Estado</label>
                <x-form.input type="text" class="viacep-loading" name="state" value="{{ old('state', $user->state) }}" />
            </div>
        
        
            
        
        
        </div>

    </div>
</div>



@section('scripts')
<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('js/jquery.mask.config.js') }}"></script>
<script src="{{ asset('js/user.js') }}"></script>
@stop