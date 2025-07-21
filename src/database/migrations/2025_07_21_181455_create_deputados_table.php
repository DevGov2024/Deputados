<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    Schema::create('deputados', function (Blueprint $table) {
    $table->id(); // id interno do banco
    $table->integer('id_api')->unique(); // id retornado pela API
    $table->string('nome');
    $table->string('sigla_partido');
    $table->string('sigla_uf');
    $table->integer('id_legislatura');
    $table->string('url_foto')->nullable();
    $table->string('uri')->nullable();
    $table->string('uri_partido')->nullable();
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('deputados');
    }
};

