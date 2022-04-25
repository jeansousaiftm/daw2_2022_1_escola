<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Curso;

class CursoController extends Controller
{
	
	public function listaCursos() {
	
		// SELECT c.*, COUNT(a.id) AS total_alunos FROM curso AS c LEFT JOIN aluno AS a ON c.id = a.curso_id GROUP BY c.id
	
		return DB::table("curso AS c")
			->leftJoin("aluno AS a", "c.id", "=", "a.curso_id")
			->select("c.id", "c.nome", DB::raw("COUNT(a.id) AS total_alunos"))
			->groupBy("c.id", "c.nome")
			->get();
	}
	
    public function index()
    {
		$curso = new Curso();
		$cursos = $this->listaCursos();
        return view("curso.index", [
			"curso" => $curso,
			"cursos" => $cursos
		]);
    }
	
    public function store(Request $request)
    {
		$request->validate([
			"nome" => "required|max:100"
		], [
			"nome.required" => "O campo nome é obrigatório",
			"nome.max" => "O campo nome aceita no máximo :max caracteres"
		]);
		
        if ($request->get("id") != "") {
			$curso = Curso::Find($request->get("id"));
		} else {
			$curso = new Curso();
		}
		$curso->nome = $request->get("nome");
		$curso->save();
		$request->session()->flash("status", "salvo");
		return redirect("/curso");
    }

    public function edit($id)
    {
        $curso = Curso::Find($id);
		$cursos = $this->listaCursos();
		return view("curso.index", [
			"curso" => $curso,
			"cursos" => $cursos
		]);
    }

    public function destroy($id, Request $request)
    {
        Curso::Destroy($id);
		$request->session()->flash("status", "excluido");
		return redirect("/curso");
    }
}
