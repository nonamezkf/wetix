<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSoftDeletesTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    // function up berfungsi untuk membuat column baru pada table tertentu pada kasus ini menggunakan table users
    public function up()
    {
        // penjelasan
        // table('users',  =  memilih target table users
        Schema ::table('users', function(Blueprint $table){
            // menambahkan 
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    // digunakan untuk melakukan undo / menghapus column jika sudah dibuat dengan melakukan rollback
    public function down()
    {
        Schema ::table('users', function(Blueprint $table){
            $table->dropColumn('deleted_at');
        });
    }
}
