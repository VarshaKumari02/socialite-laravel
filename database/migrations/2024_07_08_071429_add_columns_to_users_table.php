<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration class
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Varsha Kumari <varsha.kumari@ahex.co.in>
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('google_id')->nullable()->after('email');
            $table->string('facebook_id')->nullable()->after('google_id');
            $table->string('github_id')->nullable()->after('facebook_id');
            $table->string('linkedin_id')->nullable()->after('github_id');
            $table->string('twitter_id')->nullable()->after('linkedin_id');

            // Make the password column nullable
            $table->string('password')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('google_id');
            $table->dropColumn('facebook_id');
            $table->dropColumn('github_id');
            $table->dropColumn('linkedin_id');
            $table->dropColumn('twitter_id');

            // Revert the password column to not nullable
            $table->string('password')->nullable(false)->change();
        });
    }
};
// end of class
// end of file