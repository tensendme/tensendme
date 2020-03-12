<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumns1WithdrawalRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('withdrawal_requests', function (Blueprint $table) {
            $table->string('user_comment')->nullable(true)->change();
            $table->unsignedBigInteger('approved_by')->nullable(true)->change();
            $table->string('comment')->nullable(true)->change();
            $table->double('amount')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('withdrawal_requests', function (Blueprint $table) {
//            $table->string('user_comment')->nullable(false)->change();
//            $table->unsignedBigInteger('approved_by')->nullable(false)->change();
            $table->dropColumn('amount');

        });
    }
}
