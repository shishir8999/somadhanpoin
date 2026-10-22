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
        // 1. Add Master AI Keys & Credentials to system_settings
        if (Schema::hasTable('system_settings')) {
            Schema::table('system_settings', function (Blueprint $table) {
                if (!Schema::hasColumn('system_settings', 'gemini_api_key')) {
                    $table->text('gemini_api_key')->nullable()->after('chatgpt_proxy_url');
                }
                if (!Schema::hasColumn('system_settings', 'gemini_account_email')) {
                    $table->string('gemini_account_email')->nullable()->after('gemini_api_key');
                }
                if (!Schema::hasColumn('system_settings', 'gemini_family_invite_url')) {
                    $table->text('gemini_family_invite_url')->nullable()->after('gemini_account_email');
                }
                if (!Schema::hasColumn('system_settings', 'openai_api_key')) {
                    $table->text('openai_api_key')->nullable()->after('gemini_family_invite_url');
                }
                if (!Schema::hasColumn('system_settings', 'claude_api_key')) {
                    $table->text('claude_api_key')->nullable()->after('openai_api_key');
                }
                if (!Schema::hasColumn('system_settings', 'grok_api_key')) {
                    $table->text('grok_api_key')->nullable()->after('claude_api_key');
                }
            });
        }

        // 2. Create ai_activation_links table (One-Time Gmail Activation Links)
        if (!Schema::hasTable('ai_activation_links')) {
            Schema::create('ai_activation_links', function (Blueprint $table) {
                $table->id();
                $table->string('token', 64)->unique(); // e.g. act_gemini_x982a17f
                $table->string('service_type'); // gemini, chatgpt, claude, grok
                $table->string('service_name'); // Google Gemini Pro, ChatGPT Plus, etc.
                $table->string('plan_id')->nullable();
                $table->integer('validity_days')->default(30);
                $table->boolean('is_used')->default(false);
                $table->string('used_by_email')->nullable()->index();
                $table->foreignId('used_by_user_id')->nullable()->constrained('users')->nullOnDelete();
                $table->timestamp('used_at')->nullable();
                $table->timestamp('expires_at')->nullable();
                $table->foreignId('created_by_admin_id')->nullable()->constrained('users')->nullOnDelete();
                $table->text('access_instructions')->nullable();
                $table->text('secret_credentials')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_activation_links');
    }
};
