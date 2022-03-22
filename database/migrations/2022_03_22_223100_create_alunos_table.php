<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Curso;

return new class extends Migration
{
    public function up()
    {
        Schema::create('aluno', function (Blueprint $table) {
            $table->id();
			$table->string("nome", 100);
			$table->string("email", 100);
			$table->string("foto", 100)->nullable();
			$table->foreignIdFor(Curso::class);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('aluno');
    }
};
