@extends("templates.main")

@section("titulo", "Cadastro de Alunos")

@section("formulario")
	<br/>
	<h1>Cadastro de Alunos</h1>
	<form method="POST" action="/aluno" class="row" enctype="multipart/form-data">
		<div class="form-group col-6">
			<label for="nome">Nome:</label>
			<input type="text" id="nome" name="nome" class="form-control" value="{{ $aluno->nome }}" required />
		</div>
		<div class="form-group col-6">
			<label for="email">E-mail:</label>
			<input type="mail" id="email" name="email" class="form-control" value="{{ $aluno->email }}" required />
		</div>
		<div class="form-group col-6">
			<label for="curso_id">Curso:</label>
			<select id="curso_id" name="curso_id" class="form-control" required>
				<option value=""></option>
				@foreach ($cursos as $curso) 
					<option value="{{ $curso->id }}" @if ($curso->id == $aluno->curso_id) selected @endif>{{ $curso->nome }}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group col-4">
			<label for="foto">Foto:</label>
			<input type="file" id="foto" name="foto" class="form-control" />
		</div>
		<div class="form-group col-2">
			@csrf
			<input type="hidden" id="id" name="id" value="{{ $aluno->id }}" />
			<a href="/aluno" class="btn btn-sm btn-primary" style="margin-top: 29px;">
				<i class="bi bi-plus-square"></i> Novo
			</a>
			<button type="submit" class="btn btn-sm btn-success" style="margin-top: 29px;">
				<i class="bi bi-save"></i> Salvar
			</button>
		</div>
	</form>
@endsection

@section("tabela")
	<br/>
	<h1>Lista de Alunos</h1>
	<table class="table table-striped">
		<colgroup>
			<col width="300">
			<col width="300">
			<col width="300">
			<col width="100">
			<col width="100">
		</colgroup>
		<thead>
			<tr>
				<th>Nome</th>
				<th>Curso</th>
				<th>Foto</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($alunos as $aluno)
				<tr>
					<td>{{ $aluno->nome }}</td>
					<td>{{ $aluno->nome_curso }}</td>
					<td>
						@if ($aluno->foto != null)
							<img src='{{ str_replace("public/", "storage/", $aluno->foto) }}' width="300"></img>
						@endif
					</td>
					<td>
						<a href="/aluno/{{ $aluno->id }}/edit" class="btn btn-warning">
							<i class="bi bi-pencil-square"></i> Editar
						</a>
					</td>
					<td>
						<form method="POST" action="/aluno/{{ $aluno->id }}">
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