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
        // 1. Add Daily Image & Prompt Limits to Subscription Plans
        if (Schema::hasTable('subscription_plans')) {
            Schema::table('subscription_plans', function (Blueprint $table) {
                if (!Schema::hasColumn('subscription_plans', 'daily_image_limit')) {
                    $table->integer('daily_image_limit')->default(15)->after('available_seats');
                }
                if (!Schema::hasColumn('subscription_plans', 'daily_prompt_limit')) {
                    $table->integer('daily_prompt_limit')->default(50)->after('daily_image_limit');
                }
            });
        }

        // 2. Add Daily Usage Counters to Users
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'daily_images_used')) {
                    $table->integer('daily_images_used')->default(0)->after('max_tokens');
                }
                if (!Schema::hasColumn('users', 'daily_prompts_used')) {
                    $table->integer('daily_prompts_used')->default(0)->after('daily_images_used');
                }
                if (!Schema::hasColumn('users', 'daily_usage_date')) {
                    $table->date('daily_usage_date')->nullable()->after('daily_prompts_used');
                }
            });
        }

        // 3. Add Activation Link & Email dispatch record to Payment Orders
        if (Schema::hasTable('payment_orders')) {
            Schema::table('payment_orders', function (Blueprint $table) {
                if (!Schema::hasColumn('payment_orders', 'activation_link_url')) {
                    $table->text('activation_link_url')->nullable()->after('seat_key');
                }
                if (!Schema::hasColumn('payment_orders', 'email_sent')) {
                    $table->boolean('email_sent')->default(true)->after('activation_link_url');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('subscription_plans')) {
            Schema::table('subscription_plans', function (Blueprint $table) {
                $table->dropColumn(['daily_image_limit', 'daily_prompt_limit']);
            });
        }
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn(['daily_images_used', 'daily_prompts_used', 'daily_usage_date']);
            });
        }
        if (Schema::hasTable('payment_orders')) {
            Schema::table('payment_orders', function (Blueprint $table) {
                $table->dropColumn(['activation_link_url', 'email_sent']);
            });
        }
    }
};
