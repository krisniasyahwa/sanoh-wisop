<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id('doc_id'); // Primary key
            $table->string('doc_partno'); // Nomor part dari dokumen
            $table->enum('doc_type', ['WI', 'SOP', 'SPIS', 'SPSS']); // Jenis dokumen
            $table->string('doc_path'); // Path lokasi penyimpanan dokumen
            $table->string('doc_rev')->nullable(); // Revisi dokumen (bisa kosong/null)
            $table->date('doc_effective_date')->nullable(); // Tanggal efektif dokumen
            $table->date('doc_expired_date')->nullable(); // Tanggal kadaluarsa dokumen
            $table->enum('doc_status', ['0', '1'])->default('0'); // Status dokumen (0 -> inactive, 1 -> active)
            $table->string('doc_customer')->nullable(); // Informasi pelanggan terkait (bisa kosong/null)
            $table->enum('doc_dept', ['brazing', 'chassis', 'nylon', 'warehouse']); // Departemen terkait dokumen
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
