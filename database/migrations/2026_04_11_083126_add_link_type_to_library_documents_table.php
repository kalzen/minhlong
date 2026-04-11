<?php

use App\Models\LibraryDocument;
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
        Schema::table('library_documents', function (Blueprint $table) {
            $table->string('link_type', 16)->default('internal')->after('external_url');
        });

        foreach (LibraryDocument::query()->cursor() as $document) {
            if (filled($document->external_url) && $document->getFirstMedia('file') === null) {
                $document->updateQuietly(['link_type' => LibraryDocument::LINK_EXTERNAL]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('library_documents', function (Blueprint $table) {
            $table->dropColumn('link_type');
        });
    }
};
