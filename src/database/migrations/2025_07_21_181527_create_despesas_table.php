<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('despesas', function (Blueprint $table) {
    $table->id();
    $table->foreignId('deputado_id')->constrained('deputados')->onDelete('cascade');

    $table->integer('ano');
    $table->integer('mes');
    $table->string('tipo_despesa');
    $table->bigInteger('cod_documento')->nullable();
    $table->string('tipo_documento')->nullable();
    $table->date('data_documento')->nullable();
    $table->string('num_documento')->nullable();
    $table->decimal('valor_documento', 12, 2)->default(0);
    $table->string('url_documento')->nullable();
    $table->string('nome_fornecedor')->nullable();
    $table->string('cnpj_cpf_fornecedor')->nullable();

    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('despesas');
    }
};
