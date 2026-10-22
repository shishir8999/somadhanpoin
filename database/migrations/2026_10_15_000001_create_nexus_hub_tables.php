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
        // 1. Subscription Plans
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->string('id')->primary(); // e.g. chatgpt-plus, canva-pro
            $table->string('name');
            $table->string('provider');
            $table->string('category');
            $table->text('description');
            $table->string('icon_name');
            $table->string('badge')->nullable();
            $table->boolean('is_out_of_stock')->default(false);
            $table->decimal('price_bdt', 10, 2);
            $table->decimal('price_usd', 10, 2);
            $table->decimal('original_price_bdt', 10, 2);
            $table->string('billing_cycle')->default('monthly');
            $table->json('features')->nullable();
            $table->string('access_type')->default('in_app_chat');
            $table->string('direct_domain_url')->nullable();
            $table->string('default_model_id')->nullable();
            $table->integer('available_seats')->default(50);
            $table->integer('total_sold')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('brand_color')->nullable();
            $table->text('credentials_guide')->nullable();
            $table->timestamps();
        });

        // 2. Payment Orders
        Schema::create('payment_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('user_name');
            $table->string('user_email');
            $table->string('plan_id');
            $table->string('plan_name');
            $table->decimal('amount_bdt', 10, 2);
            $table->decimal('amount_usd', 10, 2);
            $table->string('method');
            $table->string('sender_number');
            $table->string('trx_id');
            $table->string('status')->default('pending'); // approved, pending, rejected
            $table->timestamp('approved_at')->nullable();
            $table->string('seat_key')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });

        // 3. Reseller Client Sales
        Schema::create('reseller_client_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reseller_id')->constrained('users')->cascadeOnDelete();
            $table->string('client_name');
            $table->string('client_phone');
            $table->string('client_email')->nullable();
            $table->string('plan_id');
            $table->string('plan_name');
            $table->integer('duration_days')->default(30);
            $table->string('duration_label')->default('১ মাস (৩০ দিন)');
            $table->date('start_date');
            $table->date('expiry_date');
            $table->string('seat_key')->unique();
            $table->decimal('wholesale_cost_bdt', 10, 2);
            $table->decimal('selling_price_bdt', 10, 2);
            $table->decimal('profit_bdt', 10, 2);
            $table->string('status')->default('active'); // active, expiring_soon, expired
            $table->text('credentials_or_url')->nullable();
            $table->timestamps();
        });

        // 4. Chat Messages
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('conversation_id')->nullable()->index();
            $table->enum('role', ['user', 'assistant', 'system'])->default('user');
            $table->longText('content');
            $table->string('model_id')->default('chatgpt-4o');
            $table->integer('tokens_estimated')->nullable();
            $table->string('attached_doc_name')->nullable();
            $table->timestamps();
        });

        // 5. User Documents (Vault)
        Schema::create('user_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('name');
            $table->string('size');
            $table->string('type');
            $table->longText('content')->nullable();
            $table->string('file_path')->nullable();
            $table->timestamps();
        });

        // 6. System Settings
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('app_name')->default('OmniCraft AI');
            $table->string('brand_prefix')->nullable()->default('OmniCraft');
            $table->string('brand_suffix')->nullable()->default('AI');
            $table->string('brand_tagline')->nullable()->default('All-in-One Smartest AI Workspace & Subscription Hub');
            $table->string('brand_tagline_bn')->nullable()->default('এক ক্লিকে সকল প্রিমিয়াম সাবস্ক্রিপশন ও ওয়ার্কস্পেস');
            $table->text('announcement_text')->nullable();
            $table->string('usa_showcase_title')->nullable()->default('OmniCraft AI Workspace (ইউএসএ ফিচার লাইভ পেজ)');
            $table->string('badge_text')->nullable()->default('অফিশিয়াল রিসেলার ও ১-ক্লিক ডেলিভারি');
            $table->string('primary_color')->default('blue');
            $table->string('logo_icon')->default('Sparkles');
            $table->string('custom_domain')->default('omnicraft.ai');
            $table->decimal('default_credit_percentage', 5, 2)->default(10.00);
            $table->string('bkash_merchant')->nullable()->default('01700112233');
            $table->string('nagad_merchant')->nullable()->default('01800112233');
            $table->string('rocket_merchant')->nullable()->default('01900112233');
            $table->string('upay_merchant')->nullable()->default('01600112233');
            $table->boolean('auto_approve_payments')->default(true);
            $table->string('currency')->default('BDT');
            $table->decimal('bdt_to_usd_rate', 10, 2)->default(122.00);
            $table->string('chatgpt_proxy_url')->nullable()->default('https://chatgpt.com');
            $table->string('support_phone')->nullable()->default('+880 1700-000000');
            $table->string('support_email')->nullable()->default('support@nexusai.hub');
            $table->boolean('enable_usa_feature_page')->default(true);
            $table->boolean('enable_in_app_chat')->default(true);
            $table->boolean('enable_domain_proxy')->default(true);
            $table->boolean('enable_reseller_network')->default(true);
            $table->boolean('enable_floating_chat')->default(true);
            $table->boolean('enable_header_marquee')->default(true);
            $table->timestamps();
        });

        // 7. Wishlists
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('plan_id');
            $table->timestamps();
            $table->unique(['user_id', 'plan_id']);
        });

        // 8. Customer Reviews
        Schema::create('customer_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->integer('rating')->default(5);
            $table->boolean('verified')->default(true);
            $table->string('review_date');
            $table->text('comment_bn');
            $table->string('product_name');
            $table->timestamps();
        });

        // 9. FAQ Items
        Schema::create('faq_items', function (Blueprint $table) {
            $table->id();
            $table->text('question_bn');
            $table->text('answer_bn');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faq_items');
        Schema::dropIfExists('customer_reviews');
        Schema::dropIfExists('wishlists');
        Schema::dropIfExists('system_settings');
        Schema::dropIfExists('user_documents');
        Schema::dropIfExists('chat_messages');
        Schema::dropIfExists('reseller_client_sales');
        Schema::dropIfExists('payment_orders');
        Schema::dropIfExists('subscription_plans');
    }
};
