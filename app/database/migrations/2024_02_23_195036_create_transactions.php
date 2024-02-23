<?php

use Leaf\Schema;
use Leaf\Database;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactions extends Database
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        if (!static::$capsule::schema()->hasTable('transactions')) :
            static::$capsule::schema()->create('transactions', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('source_user_id');
                $table->integer('target_user_id');
                $table->decimal('amount', 10, 2);
                $table->dateTime('transaction_date');
                $table->timestamps();
            });
        endif;

        // you can now build your migrations with schemas.
        // see: https://leafphp.dev/docs/mvc/schema.html
        // Schema::build('transactions');
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        static::$capsule::schema()->dropIfExists('transactions');
    }
}
