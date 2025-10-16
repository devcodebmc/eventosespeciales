<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = "
            CREATE EVENT IF NOT EXISTS auto_deactivate_promotions
            ON SCHEDULE EVERY 1 MINUTE
            STARTS CURRENT_TIMESTAMP
            DO
            BEGIN
                UPDATE promotions 
                SET is_active = 0 
                WHERE is_active = 1 
                AND ends_at <= NOW() 
                AND ends_at IS NOT NULL;
            END
        ";
        
        DB::unprepared($query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP EVENT IF EXISTS auto_deactivate_promotions');
    }
};
