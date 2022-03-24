<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CursoController;

Route::Resources([
	"aluno" => AlunoController::class,
	"curso" => CursoController::class
]);

Route::get('/', function () {
    return view('welcome');
});
