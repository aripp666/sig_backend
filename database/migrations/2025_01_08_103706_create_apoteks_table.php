<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('apoteks', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('alamat');
            $table->string('kecamatan');
            $table->string('waktu_operasional');
            $table->string('no_telp');
            $table->decimal('longitude', 10, 6);
            $table->decimal('latitude', 10, 6);
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('apoteks');
    }
};
