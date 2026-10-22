<?php

namespace Database\Seeders;

use App\Models\CustomerReview;
use App\Models\FaqItem;
use App\Models\PaymentOrder;
use App\Models\ResellerClientSale;
use App\Models\SubscriptionPlan;
use App\Models\SystemSetting;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\AiServiceAsset;
use App\Models\Voucher;
use App\Models\BusinessGuide;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Initial Users
        $superAdmin = User::updateOrCreate(
            ['email' => 'shishir@nexusai.hub'],
            [
                'name' => 'Shishir Barai (Super Admin)',
                'phone' => '01711000000',
                'password' => Hash::make('admin123456'),
                'role' => 'super_admin',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=250&q=80',
                'current_plan_id' => 'chatgpt-plus',
                'subscription_start_date' => Carbon::now()->subDays(10),
                'subscription_expiry' => Carbon::now()->addDays(20),
                'token_usage' => 42000,
                'max_tokens' => 200000,
                'active_seat_key' => 'NEXUS-SH-99214-X',
                'wallet_balance_bdt' => 50000.00,
                'reseller_discount_percent' => 35.00,
                'joined_at' => Carbon::now()->subMonths(3),
            ]
        );

        $reseller = User::updateOrCreate(
            ['email' => 'rahim@reseller.com'],
            [
                'name' => 'Rahim Telecom & IT',
                'phone' => '01822334455',
                'password' => Hash::make('reseller123456'),
                'role' => 'reseller',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=250&q=80',
                'current_plan_id' => 'chatgpt-plus',
                'subscription_start_date' => Carbon::now()->subDays(5),
                'subscription_expiry' => Carbon::now()->addDays(25),
                'token_usage' => 15000,
                'max_tokens' => 100000,
                'active_seat_key' => 'RESELL-RT-11029',
                'wallet_balance_bdt' => 14500.00,
                'reseller_discount_percent' => 25.00,
                'joined_at' => Carbon::now()->subMonths(1),
            ]
        );

        $user = User::updateOrCreate(
            ['email' => 'tanvir@gmail.com'],
            [
                'name' => 'Tanvir Ahmed',
                'phone' => '01933445566',
                'password' => Hash::make('user123456'),
                'role' => 'user',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=250&q=80',
                'current_plan_id' => 'chatgpt-plus',
                'subscription_start_date' => Carbon::now()->subDays(2),
                'subscription_expiry' => Carbon::now()->addDays(28),
                'token_usage' => 8400,
                'max_tokens' => 50000,
                'active_seat_key' => 'CLIENT-TA-88201',
                'wallet_balance_bdt' => 0.00,
                'reseller_discount_percent' => 0.00,
                'joined_at' => Carbon::now()->subWeeks(2),
            ]
        );

        // 2. Initial Subscription Plans
        $plans = [
            [
                'id' => 'chatgpt-plus',
                'name' => 'ChatGPT Plus',
                'provider' => 'OpenAI',
                'category' => 'AI & Education Tools',
                'description' => 'GPT-4o ও DALL-E আনলিমিটেড অ্যাক্সেস, ইন-অ্যাপ চ্যাট এবং নিজস্ব ডোমেইন প্রক্সি ভিউ।',
                'icon_name' => 'Sparkles',
                'badge' => 'HOT',
                'is_out_of_stock' => false,
                'price_bdt' => 400.00,
                'price_usd' => 3.50,
                'original_price_bdt' => 2450.00,
                'billing_cycle' => 'monthly',
                'features' => [
                    'GPT-4o ও GPT-4o mini ফুল অ্যাক্সেস',
                    'প্ল্যাটফর্মের ভিতরেই ডিরেক্ট প্রাইভেট চ্যাট উইন্ডো',
                    'চ্যাটজিপিটি অফিসিয়াল ডোমেইন রিভার্স প্রক্সি',
                    'কঠোর প্রাইভেসি: আপনার চ্যাট হিস্ট্রি সম্পূর্ণ গোপন',
                    'ডকুমেন্ট ও ফাইল আপলোড করে প্রাইভেট অ্যানালাইসিস'
                ],
                'access_type' => 'in_app_chat',
                'direct_domain_url' => 'https://chatgpt.com',
                'default_model_id' => 'chatgpt-4o',
                'available_seats' => 48,
                'total_sold' => 312,
                'is_active' => true,
                'brand_color' => '#10A37F'
            ],
            [
                'id' => 'canva-pro',
                'name' => 'Canva Pro',
                'provider' => 'Other',
                'category' => 'Editing Tools',
                'description' => '১০০+ মিলিয়ন প্রিমিয়াম স্টক ফটো, ম্যাজিক রিসাইজ, ব্র্যান্ড কিট এবং ব্যাকগ্রাউন্ড রিমুভার।',
                'icon_name' => 'Palette',
                'badge' => 'BEST SELLER',
                'is_out_of_stock' => false,
                'price_bdt' => 50.00,
                'price_usd' => 0.50,
                'original_price_bdt' => 650.00,
                'billing_cycle' => 'monthly',
                'features' => [
                    'Canva Pro ফুল লাইসেন্স',
                    'ম্যাজিক স্টুডিও ও এআই টুলস',
                    '১০০+ মিলিয়ন প্রিমিয়াম এলিমেন্টস',
                    'ইনস্ট্যান্ট ইনভাইটেশন লিংক ডেলিভারি'
                ],
                'access_type' => 'credentials',
                'direct_domain_url' => 'https://canva.com',
                'default_model_id' => 'general',
                'available_seats' => 85,
                'total_sold' => 940,
                'is_active' => true,
                'brand_color' => '#00C4CC'
            ],
            [
                'id' => 'capcut-pro',
                'name' => 'CapCut Pro',
                'provider' => 'Other',
                'category' => 'Editing Tools',
                'description' => 'প্রিমিয়াম ভিডিও ইফেক্ট, অটো ক্যাপশন, এআই বডি ইফেক্ট এবং 4K এক্সপোর্ট সুবিধা।',
                'icon_name' => 'Code',
                'badge' => 'TRENDING',
                'is_out_of_stock' => false,
                'price_bdt' => 300.00,
                'price_usd' => 2.50,
                'original_price_bdt' => 1200.00,
                'billing_cycle' => 'monthly',
                'features' => [
                    'CapCut Pro প্রিমিয়াম ইফেক্টস',
                    'অটো-ক্যাপশন ও এআই সাবটাইটেল',
                    'উইন্ডোজ, ম্যাক ও মোবাইল সাপোর্ট',
                    'নো ওয়াটারমার্ক 4K এক্সপোর্ট'
                ],
                'access_type' => 'credentials',
                'direct_domain_url' => 'https://capcut.com',
                'default_model_id' => 'general',
                'available_seats' => 35,
                'total_sold' => 420,
                'is_active' => true,
                'brand_color' => '#000000'
            ],
            [
                'id' => 'gemini-advance',
                'name' => 'Gemini Advance (AI Pro)',
                'provider' => 'Google',
                'category' => 'AI & Education Tools',
                'description' => 'গুগলের শক্তিশালী Gemini 1.5 Pro ও আল্ট্রা মডেলের আনলিমিটেড অ্যাক্সেস ও ২ মিলিয়ন টোকেন।',
                'icon_name' => 'Cpu',
                'badge' => 'POPULAR',
                'is_out_of_stock' => false,
                'price_bdt' => 250.00,
                'price_usd' => 2.20,
                'original_price_bdt' => 2400.00,
                'billing_cycle' => 'monthly',
                'features' => [
                    'Gemini 1.5 Pro ও Flash লাইভ ইঞ্জিন',
                    'ইন-প্ল্যাটফর্ম প্রাইভেট চ্যাট উইন্ডো',
                    'বড় বই ও ডেটাসেট পড়ার ক্ষমতা',
                    'গুগল ওয়ার্কস্পেস ইন্টিগ্রেশন'
                ],
                'access_type' => 'in_app_chat',
                'direct_domain_url' => 'https://gemini.google.com',
                'default_model_id' => 'chatgpt-4o',
                'available_seats' => 60,
                'total_sold' => 215,
                'is_active' => true,
                'brand_color' => '#4285F4'
            ],
            [
                'id' => 'netflix-4k',
                'name' => 'Netflix Premium 4K UHD',
                'provider' => 'Netflix',
                'category' => 'OTT & Streaming',
                'description' => 'আল্ট্রা এইচডি ৪কে রেজোলিউশন, সিঙ্গেল প্রাইভেট স্ক্রিন প্রোফাইল পিন লক সহ।',
                'icon_name' => 'Film',
                'badge' => 'HOT',
                'is_out_of_stock' => false,
                'price_bdt' => 250.00,
                'price_usd' => 2.20,
                'original_price_bdt' => 1200.00,
                'billing_cycle' => 'monthly',
                'features' => [
                    'Ultra HD 4K + HDR স্ট্রিমিং',
                    'প্রাইভেট প্রোফাইল উইথ পিন লক',
                    'টিভি, মোবাইল, ল্যাপটপ সাপোর্ট',
                    'সম্পূর্ণ মেয়াদে গ্যারান্টিযুক্ত সার্ভিস'
                ],
                'access_type' => 'credentials',
                'direct_domain_url' => 'https://netflix.com',
                'default_model_id' => 'general',
                'available_seats' => 22,
                'total_sold' => 1240,
                'is_active' => true,
                'brand_color' => '#E50914'
            ],
            [
                'id' => 'prime-video',
                'name' => 'Amazon Prime Video',
                'provider' => 'Other',
                'category' => 'OTT & Streaming',
                'description' => 'অ্যামাজন প্রাইমের সকল লেটেস্ট মুভি ও এক্সক্লুসিভ সিরিজের আল্ট্রা এইচডি স্ট্রিমিং।',
                'icon_name' => 'Film',
                'badge' => '',
                'is_out_of_stock' => false,
                'price_bdt' => 150.00,
                'price_usd' => 1.30,
                'original_price_bdt' => 700.00,
                'billing_cycle' => 'monthly',
                'features' => [
                    '4K UHD + ডলবি অডিও',
                    'সব ধরনের ডিভাইসে চলে',
                    'অফলাইন ডাউনলোড সুবিধা',
                    '১ মাস নিরবচ্ছিন্ন মেয়াদ'
                ],
                'access_type' => 'credentials',
                'direct_domain_url' => 'https://primevideo.com',
                'default_model_id' => 'general',
                'available_seats' => 40,
                'total_sold' => 580,
                'is_active' => true,
                'brand_color' => '#00A8E1'
            ],
            [
                'id' => 'windows-11-pro',
                'name' => 'Windows 11 Pro Retail Key',
                'provider' => 'Microsoft',
                'category' => 'Windows',
                'description' => '১০০% জেনুইন রিটেইল ডিজিটাল লাইসেন্স কি। লাইফটাইম অ্যাক্টিভেশন ও অফিশিয়াল আপডেট।',
                'icon_name' => 'CheckCircle',
                'badge' => 'GENUINE',
                'is_out_of_stock' => false,
                'price_bdt' => 450.00,
                'price_usd' => 3.90,
                'original_price_bdt' => 2500.00,
                'billing_cycle' => 'lifetime',
                'features' => [
                    'লাইফটাইম পার্মানেন্ট অ্যাক্টিভেশন',
                    'মাইক্রোসফট অফিসিয়াল ওটিএ আপডেট',
                    'বিট-লকার ও সিকিউর বুট সাপোর্ট',
                    'ইনস্ট্যান্ট ডিজিটাল কি ডেলিভারি'
                ],
                'access_type' => 'credentials',
                'direct_domain_url' => 'https://microsoft.com',
                'default_model_id' => 'general',
                'available_seats' => 150,
                'total_sold' => 890,
                'is_active' => true,
                'brand_color' => '#0078D4'
            ],
            [
                'id' => 'office-365',
                'name' => 'Microsoft 365 Pro + 5TB Cloud',
                'provider' => 'Microsoft',
                'category' => 'Microsoft Office',
                'description' => 'Word, Excel, PowerPoint সহ প্রিমিয়াম অফিস অ্যাপস ও ৫ টেরাবাইট ওয়ানড্রাইভ ক্লাউড।',
                'icon_name' => 'Layers',
                'badge' => 'OFFICIAL',
                'is_out_of_stock' => false,
                'price_bdt' => 550.00,
                'price_usd' => 4.80,
                'original_price_bdt' => 3200.00,
                'billing_cycle' => 'yearly',
                'features' => [
                    '৫টি ডিভাইসে একসাথে ব্যবহারের সুবিধা',
                    '৫ টেরাবাইট নিরাপদ ওয়ানড্রাইভ স্টোরেজ',
                    'উইন্ডোজ, ম্যাক, আইপ্যাড ও অ্যান্ড্রয়েড',
                    '১ বছর ফুল রিপ্লেসমেন্ট ওয়ারেন্টি'
                ],
                'access_type' => 'credentials',
                'direct_domain_url' => 'https://office.com',
                'default_model_id' => 'general',
                'available_seats' => 45,
                'total_sold' => 610,
                'is_active' => true,
                'brand_color' => '#D83B01'
            ],
            [
                'id' => 'nordvpn',
                'name' => 'NordVPN 2-Year Ultra',
                'provider' => 'Other',
                'category' => 'VPN & Security',
                'description' => 'সর্বোচ্চ গতির নিরাপদ ভিপিএন, ডাবল এনক্রিপশন এবং ম্যালওয়্যার প্রোটেকশন।',
                'icon_name' => 'ShieldCheck',
                'badge' => 'TOP SECURITY',
                'is_out_of_stock' => false,
                'price_bdt' => 300.00,
                'price_usd' => 2.60,
                'original_price_bdt' => 1800.00,
                'billing_cycle' => 'monthly',
                'features' => [
                    '৬০০০+ হাই-স্পিড গ্লোবাল সার্ভার',
                    'নো-লগ পলিসি অডিটেড',
                    'P2P টরেন্টিং ও স্ট্রিমিং অপটিমাইজড',
                    'সব অপারেটিং সিস্টেমে অ্যাপ সাপোর্ট'
                ],
                'access_type' => 'credentials',
                'direct_domain_url' => 'https://nordvpn.com',
                'default_model_id' => 'general',
                'available_seats' => 60,
                'total_sold' => 430,
                'is_active' => true,
                'brand_color' => '#4687FF'
            ],
            [
                'id' => 'claude-pro',
                'name' => 'Claude 3.5 Sonnet Pro',
                'provider' => 'Anthropic',
                'category' => 'AI & Education Tools',
                'description' => 'কোডিং ও জটিল লজিক্যাল গবেষণার জন্য বিশ্বের সেরা এআই মডেলের নিরবচ্ছিন্ন অ্যাক্সেস।',
                'icon_name' => 'Bot',
                'badge' => 'INTELLIGENT',
                'is_out_of_stock' => false,
                'price_bdt' => 450.00,
                'price_usd' => 3.90,
                'original_price_bdt' => 2600.00,
                'billing_cycle' => 'monthly',
                'features' => [
                    'Claude 3.5 Sonnet লাইভ অ্যাক্সেস',
                    '২০০,০০০ টোকেন কনটেক্সট উইন্ডো',
                    'অসাধারণ কোডিং ও রিফ্যাক্টরিং সক্ষমতা',
                    'ইন-অ্যাপ প্রাইভেট ওয়ার্কস্পেস'
                ],
                'access_type' => 'in_app_chat',
                'direct_domain_url' => 'https://claude.ai',
                'default_model_id' => 'claude-3-5',
                'available_seats' => 25,
                'total_sold' => 195,
                'is_active' => true,
                'brand_color' => '#D97706'
            ],
            [
                'id' => 'midjourney-pro',
                'name' => 'Midjourney v6.1 Pro',
                'provider' => 'Midjourney',
                'category' => 'AI & Education Tools',
                'description' => 'ফটো-রিয়ালিস্টিক ও সিনেমাটিক ইমেজ জেনারেশনের জন্য সেরা এআই টুল।',
                'icon_name' => 'Sparkles',
                'badge' => 'CREATIVE',
                'is_out_of_stock' => false,
                'price_bdt' => 650.00,
                'price_usd' => 5.50,
                'original_price_bdt' => 3600.00,
                'billing_cycle' => 'monthly',
                'features' => [
                    'v6.1 আল্ট্রা ডিটেইলড রেন্ডারিং',
                    'ফাস্ট জেনারেশন আওয়ার্স',
                    'কাস্টম স্টাইল ও ক্যামেরা অ্যাঙ্গেল গাইড',
                    'ইন-প্ল্যাটফর্ম প্রম্পট অপটিমাইজার'
                ],
                'access_type' => 'in_app_chat',
                'direct_domain_url' => 'https://midjourney.com',
                'default_model_id' => 'midjourney-prompter',
                'available_seats' => 18,
                'total_sold' => 340,
                'is_active' => true,
                'brand_color' => '#9333EA'
            ],
            [
                'id' => 'lipika-pro',
                'name' => 'Lipika All-in-One Pro Bundle',
                'provider' => 'LipikaAI',
                'category' => 'Full Bundle',
                'description' => 'ChatGPT + Claude + Canva Pro + Gemini + Netflix একসাথে এক সাবস্ক্রিপশনে।',
                'icon_name' => 'Zap',
                'badge' => 'SUPER SAVER',
                'is_out_of_stock' => false,
                'price_bdt' => 999.00,
                'price_usd' => 8.50,
                'original_price_bdt' => 8500.00,
                'billing_cycle' => 'monthly',
                'features' => [
                    'সকল প্রিমিয়াম এআই মডেল অ্যাক্সেস',
                    'ক্যানভা প্রো ও ওটিটি স্ট্রিমিং বান্ডেল',
                    'সর্বোচ্চ প্রায়োরিটি সার্ভার অ্যাক্সেস',
                    '২৪/৭ ভিআইপি সাপোর্ট ও প্রাইভেট ভল্ট'
                ],
                'access_type' => 'in_app_chat',
                'direct_domain_url' => 'https://omnicraft.ai',
                'default_model_id' => 'chatgpt-4o',
                'available_seats' => 30,
                'total_sold' => 450,
                'is_active' => true,
                'brand_color' => '#3B82F6'
            ]
        ];

        foreach ($plans as $planData) {
            SubscriptionPlan::updateOrCreate(['id' => $planData['id']], $planData);
        }

        // 3. System Settings
        SystemSetting::updateOrCreate(
            ['id' => 1],
            [
                'app_name' => 'OmniCraft AI',
                'brand_prefix' => 'OmniCraft',
                'brand_suffix' => 'AI',
                'brand_tagline' => 'All-in-One Smartest AI Workspace & Subscription Hub',
                'brand_tagline_bn' => 'এক ক্লিকে সকল প্রিমিয়াম এআই ও ডিজিটাল সাবস্ক্রিপশন',
                'announcement_text' => '🔥 বিশেষ অফার: ChatGPT Plus ও Canva Pro তে আজ পাচ্ছেন সর্বোচ্চ ৭০% ছাড়! বিকাশ/নগদে তাৎক্ষণিক অ্যাক্টিভেশন!',
                'usa_showcase_title' => 'OmniCraft AI Workspace (ইউএসএ ফিচার লাইভ পেজ)',
                'badge_text' => 'অফিশিয়াল রিসেলার ও ১-ক্লিক ডেলিভারি',
                'primary_color' => 'blue',
                'logo_icon' => 'Sparkles',
                'custom_domain' => 'omnicraft.ai',
                'default_credit_percentage' => 10.00,
                'bkash_merchant' => '01711223344',
                'nagad_merchant' => '01811223344',
                'rocket_merchant' => '01911223344',
                'upay_merchant' => '01611223344',
                'auto_approve_payments' => true,
                'currency' => 'BDT',
                'bdt_to_usd_rate' => 122.00,
                'chatgpt_proxy_url' => 'https://chatgpt.com',
                'support_phone' => '+880 1700-000000',
                'support_email' => 'support@nexusai.hub',
                'enable_usa_feature_page' => true,
                'enable_in_app_chat' => true,
                'enable_domain_proxy' => true,
                'enable_reseller_network' => true,
                'enable_floating_chat' => true,
                'enable_header_marquee' => true,
            ]
        );

        // 4. Sample Orders
        $orders = [
            [
                'order_code' => 'ORD-1011',
                'user_id' => $user->id,
                'user_name' => 'Tanvir Ahmed',
                'user_email' => 'tanvir@gmail.com',
                'plan_id' => 'chatgpt-plus',
                'plan_name' => 'ChatGPT Plus',
                'amount_bdt' => 400.00,
                'amount_usd' => 3.50,
                'method' => 'bkash',
                'sender_number' => '01711223344',
                'trx_id' => 'BK99214AX8',
                'status' => 'approved',
                'approved_at' => Carbon::now()->subDays(2),
                'seat_key' => 'NEXUS-SH-99214-X',
                'note' => 'অটো-ভেরিফায়েড ইনস্ট্যান্ট ডেলিভারি',
            ],
            [
                'order_code' => 'ORD-1012',
                'user_id' => $user->id,
                'user_name' => 'Tanvir Ahmed',
                'user_email' => 'tanvir@gmail.com',
                'plan_id' => 'canva-pro',
                'plan_name' => 'Canva Pro',
                'amount_bdt' => 50.00,
                'amount_usd' => 0.50,
                'method' => 'nagad',
                'sender_number' => '01822334455',
                'trx_id' => 'NG77123MN4',
                'status' => 'approved',
                'approved_at' => Carbon::now()->subDays(5),
                'seat_key' => 'CANVA-PRO-INV-99',
                'note' => 'ইনভাইটেশন লিংক সফলভাবে পাঠানো হয়েছে',
            ]
        ];

        foreach ($orders as $orderData) {
            PaymentOrder::updateOrCreate(['order_code' => $orderData['order_code']], $orderData);
        }

        // 5. Sample Reseller Sales
        $resellerSales = [
            [
                'reseller_id' => $reseller->id,
                'client_name' => 'Fahim Rahman',
                'client_phone' => '01712345678',
                'client_email' => 'fahim.design@gmail.com',
                'plan_id' => 'chatgpt-plus',
                'plan_name' => 'ChatGPT Plus',
                'duration_days' => 30,
                'duration_label' => '১ মাস (৩০ দিন)',
                'start_date' => Carbon::now()->subDays(5)->toDateString(),
                'expiry_date' => Carbon::now()->addDays(25)->toDateString(),
                'seat_key' => 'RESELL-FR-9901',
                'wholesale_cost_bdt' => 300.00,
                'selling_price_bdt' => 450.00,
                'profit_bdt' => 150.00,
                'status' => 'active',
                'credentials_or_url' => 'https://chatgpt.com (Token: NEXUS-PROXY-KEY-81)',
            ],
            [
                'reseller_id' => $reseller->id,
                'client_name' => 'Sadia Islam',
                'client_phone' => '01898765432',
                'client_email' => 'sadia.writer@gmail.com',
                'plan_id' => 'canva-pro',
                'plan_name' => 'Canva Pro',
                'duration_days' => 30,
                'duration_label' => '১ মাস (৩০ দিন)',
                'start_date' => Carbon::now()->subDays(10)->toDateString(),
                'expiry_date' => Carbon::now()->addDays(20)->toDateString(),
                'seat_key' => 'RESELL-SI-7744',
                'wholesale_cost_bdt' => 37.50,
                'selling_price_bdt' => 80.00,
                'profit_bdt' => 42.50,
                'status' => 'active',
                'credentials_or_url' => 'Canva Brand Team Invitation Link',
            ]
        ];

        foreach ($resellerSales as $sale) {
            ResellerClientSale::updateOrCreate(['seat_key' => $sale['seat_key']], $sale);
        }

        // 6. Customer Reviews
        $reviews = [
            [
                'name' => 'মাহমুদুল হাসান',
                'avatar' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=150&q=80',
                'rating' => 5,
                'verified' => true,
                'review_date' => '২ দিন আগে',
                'comment_bn' => 'বিকাশে পেমেন্ট করার ২ মিনিটের মধ্যেই চ্যাটজিপিটি প্লাস অ্যাক্টিভ হয়ে গেছে! ইন-অ্যাপ চ্যাট আর অফিসিয়াল প্রক্সি ভিউ দুইটাই দারুণ কাজ করে।',
                'product_name' => 'ChatGPT Plus'
            ],
            [
                'name' => 'সুমাইয়া আক্তার',
                'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=150&q=80',
                'rating' => 5,
                'verified' => true,
                'review_date' => '৫ দিন আগে',
                'comment_bn' => 'ক্যানভা প্রো মাত্র ৫০ টাকায় পেলাম। ইনভাইট লিংক দিয়ে সাথে সাথে পার্সোনাল অ্যাকাউন্ট প্রো হয়ে গেছে। কোনো ধরনের ঝামেলা নেই।',
                'product_name' => 'Canva Pro'
            ],
            [
                'name' => 'রাকিবুল ইসলাম',
                'avatar' => 'https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?auto=format&fit=crop&w=150&q=80',
                'rating' => 5,
                'verified' => true,
                'review_date' => '১ সপ্তাহ আগে',
                'comment_bn' => 'নেটফ্লিক্সের পার্সোনাল প্রোফাইল পিন লক পেয়েছি। কোনো স্ক্রিন লিমিট বা ওটিপি সমস্যা নেই। ৪কে কোয়ালিটিতে সিনেমা দেখছি।',
                'product_name' => 'Netflix Premium 4K'
            ],
            [
                'name' => 'আরিফ আহমেদ',
                'avatar' => 'https://images.unsplash.com/photo-1527980965255-d3b416303d12?auto=format&fit=crop&w=150&q=80',
                'rating' => 5,
                'verified' => true,
                'review_date' => '২ সপ্তাহ আগে',
                'comment_bn' => 'উইন্ডোজ ১১ প্রো কি সাথে সাথেই লাইভ অ্যাক্টিভ হয়ে গেছে। মাইক্রোসফটের অফিসিয়াল আপডেটও পাচ্ছি। ধন্যবাদ অম্নিক্রাফট টিমকে।',
                'product_name' => 'Windows 11 Pro'
            ]
        ];

        foreach ($reviews as $rev) {
            CustomerReview::updateOrCreate(['name' => $rev['name'], 'product_name' => $rev['product_name']], $rev);
        }

        // 7. FAQs
        $faqs = [
            [
                'question_bn' => 'পেমেন্ট করার পর সাবস্ক্রিপশন পেতে কতক্ষণ সময় লাগে?',
                'answer_bn' => 'বিকাশ, নগদ বা রকেটে পেমেন্ট সম্পন্ন করে TrxID সাবমিট করার সাথে সাথেই স্বয়ংক্রিয় সিস্টেম ভেরিফাই করে ১ থেকে ৩ মিনিটের মধ্যে আপনার অ্যাকাউন্টে সিট কি ও ক্রেডেনশিয়াল প্রদান করে।',
                'sort_order' => 1
            ],
            [
                'question_bn' => 'ইন-অ্যাপ চ্যাট আর অফিসিয়াল প্রক্সি ভিউ এর মধ্যে পার্থক্য কী?',
                'answer_bn' => 'ইন-অ্যাপ চ্যাটে আপনি আমাদের ওয়েব প্ল্যাটফর্মের ভিতরেই সরাসরি ChatGPT-4o, Claude 3.5 এবং Gemini এর মতো একাধিক মডেল চালাতে পারবেন। আর অফিসিয়াল প্রক্সি ভিউতে আপনি নিজস্ব সেশন কি ব্যবহার করে সরাসরি chatgpt.com ডোমেইনে প্রবেশ করতে পারবেন।',
                'sort_order' => 2
            ],
            [
                'question_bn' => 'আমার ব্যক্তিগত ফাইল ও ডেটা কি নিরাপদ থাকবে?',
                'answer_bn' => 'হ্যাঁ, ১০০% নিরাপদ। আমাদের সিস্টেমে জিরো-নলেজ আর্কিটেকচার প্রয়োগ করা হয়েছে। আপনার আপলোড করা ফাইল বা চ্যাট হিস্ট্রি সম্পূর্ণ এনক্রিপ্ট থাকে এবং কোনো থার্ড-পার্টির সাথে শেয়ার করা হয় না।',
                'sort_order' => 3
            ],
            [
                'question_bn' => 'রিসেলার পার্টনারশিপ কিভাবে শুরু করা যায়?',
                'answer_bn' => 'রিসেলার ট্যাবে গিয়ে আপনি যেকোনো সময় রিসেলার অ্যাকাউন্টে স্যুইচ করতে পারেন। হোলসেল রেটে সিট ক্রয় করে আপনি আপনার গ্রাহকদের কাছে নিজস্ব দামে বিক্রি করে সর্বোচ্চ ৩০% থেকে ৫০% পর্যন্ত প্রফিট করতে পারবেন।',
                'sort_order' => 4
            ]
        ];

        foreach ($faqs as $faq) {
            FaqItem::updateOrCreate(['question_bn' => $faq['question_bn']], $faq);
        }

        // 8. Default Wishlist for user
        Wishlist::updateOrCreate(
            ['user_id' => $user->id, 'plan_id' => 'chatgpt-plus']
        );
        Wishlist::updateOrCreate(
            ['user_id' => $user->id, 'plan_id' => 'canva-pro']
        );

        // 9. AI & Service Logos and Assets
        $assets = [
            [
                'service_key' => 'chatgpt',
                'name' => 'ChatGPT / OpenAI',
                'provider' => 'OpenAI',
                'category' => 'AI Chat & LLM',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/0/04/ChatGPT_logo.svg',
                'is_active' => true,
            ],
            [
                'service_key' => 'claude',
                'name' => 'Claude (Anthropic)',
                'provider' => 'Anthropic',
                'category' => 'AI Chat & LLM',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/7/78/Anthropic_logo.svg',
                'is_active' => true,
            ],
            [
                'service_key' => 'gemini',
                'name' => 'Google Gemini Advanced',
                'provider' => 'Google',
                'category' => 'AI Chat & LLM',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/8/8a/Google_Gemini_logo.svg',
                'is_active' => true,
            ],
            [
                'service_key' => 'grok',
                'name' => 'Grok (xAI)',
                'provider' => 'xAI',
                'category' => 'AI Chat & LLM',
                'logo_url' => null,
                'is_active' => true,
            ],
            [
                'service_key' => 'canva',
                'name' => 'Canva Pro',
                'provider' => 'Canva',
                'category' => 'Graphic Design',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/3/3b/Canva_Logo.svg',
                'is_active' => true,
            ],
            [
                'service_key' => 'capcut',
                'name' => 'CapCut Pro',
                'provider' => 'ByteDance',
                'category' => 'Video Editing',
                'logo_url' => null,
                'is_active' => true,
            ],
            [
                'service_key' => 'midjourney',
                'name' => 'Midjourney',
                'provider' => 'Midjourney',
                'category' => 'AI Art & Image',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/e/e6/Midjourney_Emblem.png',
                'is_active' => true,
            ],
            [
                'service_key' => 'netflix',
                'name' => 'Netflix Premium 4K',
                'provider' => 'Netflix',
                'category' => 'OTT & Streaming',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/0/08/Netflix_2015_logo.svg',
                'is_active' => true,
            ],
            [
                'service_key' => 'prime-video',
                'name' => 'Amazon Prime Video',
                'provider' => 'Amazon',
                'category' => 'OTT & Streaming',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/f/f1/Prime_Video.png',
                'is_active' => true,
            ],
            [
                'service_key' => 'windows-11',
                'name' => 'Microsoft Windows 11',
                'provider' => 'Microsoft',
                'category' => 'Operating System',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/8/87/Windows_logo_-_2021.svg',
                'is_active' => true,
            ],
            [
                'service_key' => 'office-365',
                'name' => 'Microsoft Office 365',
                'provider' => 'Microsoft',
                'category' => 'Productivity Suite',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg',
                'is_active' => true,
            ],
            [
                'service_key' => 'quillbot',
                'name' => 'QuillBot Premium',
                'provider' => 'Learneo',
                'category' => 'Writing Assistant',
                'logo_url' => null,
                'is_active' => true,
            ],
            [
                'service_key' => 'elevenlabs',
                'name' => 'ElevenLabs Voice AI',
                'provider' => 'ElevenLabs',
                'category' => 'AI Audio & Voice',
                'logo_url' => null,
                'is_active' => true,
            ],
        ];

        foreach ($assets as $asset) {
            AiServiceAsset::updateOrCreate(['service_key' => $asset['service_key']], $asset);
        }

        // 10. Discount Vouchers
        $vouchers = [
            [
                'code' => 'OMNI2026',
                'discount_percent' => 15.00,
                'discount_bdt' => 0.00,
                'min_order_bdt' => 200.00,
                'max_uses' => 500,
                'used_count' => 12,
                'expiry_date' => Carbon::now()->addMonths(6),
                'is_active' => true,
            ],
            [
                'code' => 'WELCOME50',
                'discount_percent' => 0.00,
                'discount_bdt' => 50.00,
                'min_order_bdt' => 300.00,
                'max_uses' => 200,
                'used_count' => 45,
                'expiry_date' => Carbon::now()->addMonths(3),
                'is_active' => true,
            ],
            [
                'code' => 'RESELLERVIP',
                'discount_percent' => 25.00,
                'discount_bdt' => 0.00,
                'min_order_bdt' => 1000.00,
                'max_uses' => 100,
                'used_count' => 8,
                'expiry_date' => Carbon::now()->addYear(),
                'is_active' => true,
            ]
        ];

        foreach ($vouchers as $voucher) {
            Voucher::updateOrCreate(['code' => $voucher['code']], $voucher);
        }

        // 11. Business & Operations Guides
        $guides = [
            [
                'id' => 'reseller_blueprint',
                'title_bn' => 'ডিজিটাল সাবস্ক্রিপশন রিসেলিং সম্পূর্ণ মাস্টারক্লাস',
                'title_en' => 'Digital Subscription Reselling Masterclass Blueprint',
                'tag' => 'Business',
                'read_time' => '৭ মিনিট পাঠ',
                'description_bn' => 'কীভাবে প্রতি মাসে ঘরে বসে রিসেলিং করে ৩০,০০০ থেকে ৫০,০০০ টাকা আয় করবেন তার পূর্ণাঙ্গ ব্লুপ্রিন্ট।',
                'description_en' => 'A complete step-by-step roadmap to building a profitable subscription agency.',
                'key_points_bn' => [
                    'হোলসেল সিট ও ক্রেডেনশিয়াল ম্যানেজমেন্টের সহজ উপায়',
                    'বিকাশ ও নগদে কাস্টমার থেকে তাৎক্ষণিক পেমেন্ট রিসিভ ও অটো ডেলিভারি',
                    'সোশ্যাল মিডিয়া ও ফেসবুক গ্রুপে ক্লায়েন্ট হান্টিং কৌশল',
                    'রিটার্নিং কাস্টমার ও অটো-রিনিউয়াল স্ট্র্যাটেজি'
                ],
                'key_points_en' => [
                    'Wholesale seat and credential management',
                    'Instant bKash/Nagad payment handling',
                    'Social media client hunting techniques',
                    'Customer retention and auto-renewal'
                ],
                'full_guide_markdown_bn' => "### রিসেলিং শুরু করার ধাপসমূহ\n\n১. **হোলসেল মূল্যে সিট সংগ্রহ করুন:** অম্নিক্রাফট রিসেলার ড্যাশবোর্ড থেকে ডিসকাউন্টে সিট কি সংগ্রহ করুন।\n২. **টার্গেটেড ক্লায়েন্ট নির্ধারণ:** ছাত্রছাত্রী, ফ্রিল্যান্সার, কন্টেন্ট ক্রিয়েটরদের টার্গেট করুন।\n৩. **সার্ভিস গ্যারান্টি:** কাস্টমারকে ১০০% রিপ্লেসমেন্ট ওয়ারেন্টি দিন।",
                'is_published' => true,
            ],
            [
                'id' => 'payment_gateway_setup',
                'title_bn' => 'বিকাশ ও নগদ মার্চেন্ট/পার্সোনাল পেমেন্ট গাইডলাইন',
                'title_en' => 'bKash & Nagad Payment Operations Guide',
                'tag' => 'Operations',
                'read_time' => '৫ মিনিট পাঠ',
                'description_bn' => 'সিস্টেম সেটিংস থেকে পেমেন্ট গেটওয়ে এবং অটো-অ্যাপ্রুভাল কনফিগার করার নিয়ম।',
                'description_en' => 'How to configure gateway numbers and auto approval in OmniCraft AI.',
                'key_points_bn' => [
                    'মার্চেন্ট বা পার্সোনাল নম্বর সেটিংস এ ইনপুট দেয়া',
                    'TrxID অটো ভেরিফিকেশন অন/অফ রাখা',
                    'ম্যানুয়াল ভেরিফিকেশন ও অর্ডার স্ট্যাটাস অ্যাপ্রুভ করা'
                ],
                'key_points_en' => [
                    'Configuring merchant/personal numbers',
                    'Enabling auto TrxID verification',
                    'Manual review and instant order dispatch'
                ],
                'full_guide_markdown_bn' => "### পেমেন্ট ভেরিফিকেশন সেটআপ\n\nএডমিন প্যানেলে প্রবেশ করে **System Settings** এ গিয়ে আপনার নিজস্ব বিকাশ ও নগদ নম্বর যুক্ত করুন।",
                'is_published' => true,
            ]
        ];

        foreach ($guides as $guide) {
            BusinessGuide::updateOrCreate(['id' => $guide['id']], $guide);
        }
    }
}
