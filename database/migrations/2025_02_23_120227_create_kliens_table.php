<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKliensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kliens', function (Blueprint $table) {
            $table->id();
            $table->string('id_tiket');
            $table->string('keluhan');
            $table->string('klien');
            $table->string('unit');
            $table->string('deskripsi')->nullable();
            $table->date('tgl_keluhan');
            $table->time('jam')->nullable();
            $table->string('gambar')->nullable();
            $table->string('gambar_perbaikan')->nullable();
            $table->string('status')->default('Menunggu'); 
            $table->string('deskripsi_perbaikan')->nullable();
            $table->date('tgl_perbaikan')->nullable();
            $table->text('durasi_perbaikan')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('teknisi_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('nama_pelapor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kliens');
    }
}