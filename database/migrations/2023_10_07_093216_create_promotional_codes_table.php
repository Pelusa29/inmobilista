<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionalCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotional_codes', function (Blueprint $table) {
            $table->id();
            $table->string("promotional_code");
            $table->integer("package_id")->index();
            $table->integer("user_id")->index()->nullable();
            $table->boolean("is_used")->default(0);
            $table->date("expiration_date")->nullable();
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
        Schema::dropIfExists('promotional_codes');
    }
}
