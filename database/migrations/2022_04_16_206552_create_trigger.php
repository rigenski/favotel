<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $trigger = "CREATE TRIGGER `after_reservation_status_update` AFTER UPDATE ON `reservations` FOR EACH ROW
        BEGIN
            INSERT INTO reservation_status_histories (`reservation_id`, `status`, `created_at`, `updated_at`) VALUES (NEW.id, NEW.status, now(), null);
        END";

        \DB::unprepared($trigger);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trigger');
    }
}
