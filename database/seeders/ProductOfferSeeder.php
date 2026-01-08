<?php

namespace Database\Seeders;

use App\Helpers\PageHelper;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Offer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $userIds = User::pluck('id')->toArray();
        if (empty($userIds)) {
            $this->command->info('No users found! Please create some users first.');
            return;
        }

        // 1️⃣ Empty the tables first
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        Product::truncate();
        Offer::truncate();
        Faq::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2️⃣ Create 200 categories
        $categories = [];
        for ($i = 1; $i <= 10; $i++) {
            $category = Category::create([
                'name' => 'Category ' . $i,
                'slug' => 'category-' . $i,
                'status' => 1,
                'created_by' => $userIds[array_rand($userIds)],
                'updated_by' => $userIds[array_rand($userIds)],
            ]);
            $categories[] = $category;
        }

        // 3️⃣ Create 200 products
        for ($i = 1; $i <= 20; $i++) {
            $category = $categories[array_rand($categories)];
            Product::create([
                'category_id' => $category->id,
                'name' => 'Product ' . $i,
                'slug' => 'product-' . $i,
                'sku' => 'SKU' . $i . uniqid(),
                'short_description' => 'Short description for Product ' . $i,
                'description' => '<p>This is a <strong>fake description</strong> for Product ' . $i . ' added via CKEditor.</p>',
                'price' => rand(10, 1000),
                'discount_percent' => rand(0, 50),
                'sale_price' => rand(5, 800),
                'stock_qty' => rand(0, 100),
                'in_stock' => true,
                'thumbnail' => 'products/thumbnail' . rand(1, 5) . '.jpg',
                'gallery_images' => json_encode([   // ✅ JSON encode
                    'products/gallery' . rand(1, 3) . '.jpg',
                    'products/gallery' . rand(4, 6) . '.jpg',
                ]),
                'image_alt' => 'Product ' . $i . ' image',
                'is_active' => true,
                'meta_title' => 'Product ' . $i,
                'meta_keywords' => 'product, fake, seed',
                'meta_description' => 'Meta description for Product ' . $i,
                'created_by' => $userIds[array_rand($userIds)],
                'updated_by' => $userIds[array_rand($userIds)],
            ]);
        }

        // 4️⃣ Create 200 offers
        for ($i = 1; $i <= 10; $i++) {
            Offer::create([
                'title' => 'Offer ' . $i,
                'slug' => 'offer-' . $i,
                'short_description' => 'Short description for Offer ' . $i,
                'description' => '<p>This is a <em>fake description</em> for Offer ' . $i . ' added via CKEditor.</p>',
                'thumbnail' => 'offers/thumbnail' . rand(1, 5) . '.jpg',
                'gallery_images' => json_encode([   // ✅ JSON encode
                    'offers/gallery' . rand(1, 3) . '.jpg',
                    'offers/gallery' . rand(4, 6) . '.jpg',
                ]),
                'image_alt' => 'Offer ' . $i . ' image',
                'is_active' => true,
                'meta_title' => 'Offer ' . $i,
                'meta_keywords' => 'offer, fake, seed',
                'meta_description' => 'Meta description for Offer ' . $i,
                'created_by' => $userIds[array_rand($userIds)],
                'updated_by' => $userIds[array_rand($userIds)],
            ]);
        }

        // ----------------------
        // Seed FAQs
        // ----------------------
        $pages = PageHelper::labels(); // ✅ get labels from helper

        for ($i = 1; $i <= 50; $i++) { // create 50 FAQs
            $pageKey = array_rand($pages); // pick a random key from the helper array
            Faq::create([
                'page_name'  => $pageKey,
                'question'   => 'Sample Question ' . $i . '?',
                'answer'     => 'This is a sample answer for FAQ ' . $i . ' related to ' . $pages[$pageKey] . '.',
                'created_by' => $userIds[array_rand($userIds)],
                'updated_by' => $userIds[array_rand($userIds)],
            ]);
        }

        $this->command->info('Categories, Products, and Offers truncated and seeded successfully!');
    }
}
