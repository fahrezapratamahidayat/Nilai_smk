<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Shared fields
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->text('alamat')->nullable();

            // Teacher specific fields
            $table->string('nip')->nullable();
            $table->string('mata_pelajaran')->nullable();
            $table->enum('kelas_ajar', ['10', '11', '12'])->nullable();
            $table->enum('status_guru', ['wali_kelas', 'guru_mapel'])->nullable();

            // Student specific fields
            $table->string('nis')->nullable();
            $table->string('kelas')->nullable();
            $table->string('foto')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                // Shared fields
                'jenis_kelamin',
                'tanggal_lahir',
                'tempat_lahir',
                'alamat',

                // Teacher fields
                'nip',
                'mata_pelajaran',
                'kelas_ajar',
                'status_guru',

                // Student fields
                'nis',
                'kelas',
                'foto'
            ]);
        });
    }
};
