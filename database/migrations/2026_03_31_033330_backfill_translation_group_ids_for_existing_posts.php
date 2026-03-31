<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('posts')->orderBy('id')->each(function (object $row): void {
            if ($row->translation_group_id !== null) {
                return;
            }
            DB::table('posts')->where('id', $row->id)->update([
                'translation_group_id' => (string) Str::uuid(),
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
