<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropUnique(['slug']);
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->uuid('translation_group_id')->nullable()->after('category_id');
            $table->string('locale', 8)->default('en')->after('translation_group_id');
            $table->unique(['locale', 'slug']);
            $table->index('translation_group_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropUnique(['locale', 'slug']);
            $table->dropIndex(['translation_group_id']);
            $table->dropColumn(['translation_group_id', 'locale']);
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->unique('slug');
        });
    }
};
