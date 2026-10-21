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
        Schema::table('blog_posts', function (Blueprint $table) {
            // Rename 'image' to 'featured_image' if it exists
            if (Schema::hasColumn('blog_posts', 'image')) {
                $table->renameColumn('image', 'featured_image');
            } else {
                $table->string('featured_image')->nullable()->after('content');
            }
            
            // Add author_id
            $table->foreignId('author_id')->nullable()->after('featured_image')->constrained('users')->onDelete('set null');
            
            // Add views counter
            $table->unsignedBigInteger('views')->default(0)->after('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropColumn(['author_id', 'views']);
            
            // Rename back to 'image'
            if (Schema::hasColumn('blog_posts', 'featured_image')) {
                $table->renameColumn('featured_image', 'image');
            }
        });
    }
};
