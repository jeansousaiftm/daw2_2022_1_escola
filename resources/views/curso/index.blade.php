@extends("templates.main")

@section("titulo", "Cadastro de Cursos")

@section("formulario")
	<br/>
	<h1>Cadastro de Cursos</h1>
	<form action="/curso" method="POST" class="row">
		<div class="form-group col-10">
			<label for="nome">Nome:</label>
			<input type="text" id="nome" name="nome" 
				@class([
					"form-control", 
					"is-invalid" => ($errors->first("nome") != "")
				])
				value="{{ $curso->nome }}" />
			<div class="invalid-feedback">
				{{ $errors->first("nome") }}
			</div>
		</div>
		<div class="form-group col-2">
			@csrf
			<input type="hidden" id="id" name="id" value="{{ $curso->id }}" />
			<a href="/curso" class="btn btn-primary" style="margin-top: 23px;">
				<i class="bi bi-plus-square"></i> Novo
			</a>
			<button type="submit" class="btn btn-success" style="margin-top: 23px;">
				<i class="bi bi-save"></i> Salvar
			</button>
		</div>
	</form>
@endsection

@section("tabela")
	<br/>
	<h1>Lista de Cursos</h1>
	<table class="table table-striped">
		<colgroup>
			<col width="400">
			<col width="100">
			<col width="100">
		</colgroup>
		<thead>
			<tr>
				<th>Nome</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($cursos as $curso)
				<tr>
					<td>{{ $curso->nome }}</td>
					<td>
						<a href="/curso/{{ $curso->id }}/edit" class="btn btn-warning">
							<i class="bi bi-pencil-square"></i> Editar
						</a>
					</td>
					<td>
						<form method="POST" action="/curso/{{ $curso->id }}">
							@csrf
							<input type="hidden" name="_method" value="DELETE" />
							<button type="button" class="btn btn-danger" onclick="excluir(this);">
								<i class="bi bi-trash"></i> Excluir
							</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection	

<script>
	function excluir(btn) {
		Swal.fire({
			"title": "Deseja realmente excluir?",
			"icon": "warning",
			"showCancelButton": true,
			"cancelButtonText": "Cancelar",
			"confirmButtonText": "Confirmar",
			"confirmButtonColor": "#3085d6",
			"cancelButtonColor": "#d33"
		}).then(function(result) {
			if (result.isConfirmed) {
				$(btn).parents("form").submit();
			}
		});
	}
</script>