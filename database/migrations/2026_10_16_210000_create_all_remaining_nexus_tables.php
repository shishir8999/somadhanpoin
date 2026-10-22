<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to create all remaining MySQL tables.
     */
    public function up(): void
    {
        // 1. Add Facebook Pixel columns to system_settings if not already present
        if (Schema::hasTable('system_settings')) {
            Schema::table('system_settings', function (Blueprint $table) {
                if (!Schema::hasColumn('system_settings', 'facebook_pixel_id')) {
                    $table->string('facebook_pixel_id')->nullable()->after('enable_header_marquee');
                }
                if (!Schema::hasColumn('system_settings', 'enable_facebook_pixel')) {
                    $table->boolean('enable_facebook_pixel')->default(false)->after('facebook_pixel_id');
                }
            });
        }

        // 2. AI & Services Media Assets (Logo & Image Manager)
        if (!Schema::hasTable('ai_service_assets')) {
            Schema::create('ai_service_assets', function (Blueprint $table) {
                $table->id();
                $table->string('service_key')->unique(); // e.g. chatgpt, claude, gemini, grok, midjourney
                $table->string('name');
                $table->string('provider');
                $table->string('category')->default('AI & Education Tools');
                $table->text('logo_url')->nullable();
                $table->string('custom_upload_path')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // 3. Facebook & Marketing Pixel Events Log
        if (!Schema::hasTable('pixel_events')) {
            Schema::create('pixel_events', function (Blueprint $table) {
                $table->id();
                $table->string('event_name'); // PageView, ViewContent, InitiateCheckout, Purchase, Lead
                $table->json('event_data')->nullable();
                $table->string('pixel_id')->nullable();
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
                $table->string('user_email')->nullable();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->timestamps();
            });
        }

        // 4. Promo Vouchers & Discount Coupons
        if (!Schema::hasTable('vouchers')) {
            Schema::create('vouchers', function (Blueprint $table) {
                $table->id();
                $table->string('code')->unique(); // e.g. OMNI2026, WELCOME50
                $table->decimal('discount_percent', 5, 2)->default(0.00);
                $table->decimal('discount_bdt', 10, 2)->default(0.00);
                $table->decimal('min_order_bdt', 10, 2)->default(0.00);
                $table->integer('max_uses')->default(100);
                $table->integer('used_count')->default(0);
                $table->date('expiry_date')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // 5. Business & Operations Guides
        if (!Schema::hasTable('business_guides')) {
            Schema::create('business_guides', function (Blueprint $table) {
                $table->string('id')->primary(); // e.g. reseller_blueprint, payment_setup
                $table->string('title_bn');
                $table->string('title_en');
                $table->string('tag')->default('Operations');
                $table->string('read_time')->default('5 min');
                $table->text('description_bn')->nullable();
                $table->text('description_en')->nullable();
                $table->json('key_points_bn')->nullable();
                $table->json('key_points_en')->nullable();
                $table->longText('full_guide_markdown_bn');
                $table->boolean('is_published')->default(true);
                $table->timestamps();
            });
        }

        // 6. Admin Activity & Audit Logs
        if (!Schema::hasTable('admin_activity_logs')) {
            Schema::create('admin_activity_logs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('admin_id')->nullable()->constrained('users')->nullOnDelete();
                $table->string('admin_name');
                $table->string('action'); // e.g. user_deleted, plan_updated, settings_saved
                $table->string('module'); // users, plans, settings, orders, pixel
                $table->json('details')->nullable();
                $table->string('ip_address', 45)->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_activity_logs');
        Schema::dropIfExists('business_guides');
        Schema::dropIfExists('vouchers');
        Schema::dropIfExists('pixel_events');
        Schema::dropIfExists('ai_service_assets');

        if (Schema::hasTable('system_settings')) {
            Schema::table('system_settings', function (Blueprint $table) {
                if (Schema::hasColumn('system_settings', 'facebook_pixel_id')) {
                    $table->dropColumn('facebook_pixel_id');
                }
                if (Schema::hasColumn('system_settings', 'enable_facebook_pixel')) {
                    $table->dropColumn('enable_facebook_pixel');
                }
            });
        }
    }
};
