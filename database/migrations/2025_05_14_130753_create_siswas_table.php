<?php

// database/migrations/xxxx_xx_xx_create_siswas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nis')->unique();
            $table->enum('gender', ['L', 'P']);
            $table->text('alamat');
            $table->string('kontak');
            $table->string('email')->unique();
            $table->string('foto')->nullable();
            $table->enum('status_lapor_pkl', ['no', 'yes'])->default('no');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('siswas');
    }
}
