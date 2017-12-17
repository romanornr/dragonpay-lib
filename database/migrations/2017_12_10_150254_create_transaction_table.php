<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function(Blueprint $table){
            $table->increments('id')->unsigned();
            $table->string('address', 42);
            $table->integer('block_height')->unsigned();
            $table->string('coin', 15);
            $table->string('txhash', 65)->unique();
            $table->smallInteger('tx_input_n')->nullable();
            $table->smallInteger('tx_output_n')->nullable();
            $table->bigInteger('value')->unsigned();
            $table->integer('confirmations')->unsigned()->nullable();
            $table->string('confirmed')->nullable();
            $table->boolean('spent')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}