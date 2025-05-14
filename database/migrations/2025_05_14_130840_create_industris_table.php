<?php

// database/migrations/xxxx_xx_xx_create_industris_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndustrisTable extends Migration
{
    public function up()
    {
        Schema::create('industris', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('bidang_usaha');
            $table->text('alamat');
            $table->string('kontak');
            $table->string('email')->unique();
            $table->string('website')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('industris');
    }
}
