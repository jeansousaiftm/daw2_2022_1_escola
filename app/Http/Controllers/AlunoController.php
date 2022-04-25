<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Curso;
use Illuminate\Support\Facades\DB;

class AlunoController extends Controller
{
	
	public function listaAlunos() {
		return DB::table("aluno AS a")
					->join("curso AS c", "a.curso_id", "=", "c.id")
					->select("a.*", "c.nome AS nome_curso")
					->get();
	}
	
    public function index()
    {
        $aluno = new Aluno();
		$alunos = $this->listaAlunos();
		$cursos = Curso::All();
		return view("aluno.index", [
			"aluno" => $aluno,
			"alunos" => $alunos,
			"cursos" => $cursos
		]);
    }

    public function store(Request $request)
    {
        if ($request->get("id") != "") {
			$aluno = Aluno::Find($request->get("id"));
		} else {
			$aluno = new Aluno();
		}
		
		$aluno->nome = $request->get("nome");
		$aluno->email = $request->get("email");
		$aluno->curso_id = $request->get("curso_id");
		
		if ($request->file("foto") != null) {
			$aluno->foto = $request->file("foto")->store("public/alunos");
		}
		
		$aluno->save();
		
		$request->session()->flash("status", "salvo");
		
		return redirect("/aluno");
		
    }

    public function edit($id)
    {
        $aluno = Aluno::Find($id);
		$alunos = $this->listaAlunos();
		$cursos = Curso::All();
		return view("aluno.index", [
			"aluno" => $aluno,
			"alunos" => $alunos,
			"cursos" => $cursos
		]);
    }

    public function destroy($id, Request $request)
    {
        Aluno::Destroy($id);
		$request->session()->flash("status", "excluido");
		return redirect("/aluno");
    }
}
