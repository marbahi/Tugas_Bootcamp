<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // ===== Kategori 1: Elektronik (10) =====
            ['name' => 'iPhone 15 Pro Max', 'slug' => 'iphone-15-pro-max', 'description' => 'Smartphone flagship terbaru dari Apple dengan chip A17 Pro', 'stock' => 25, 'image' => 'iphone15.jpg', 'price' => 19999000, 'product_category_id' => 1],
            ['name' => 'Samsung Galaxy S24 Ultra', 'slug' => 'samsung-galaxy-s24-ultra', 'description' => 'Smartphone premium Samsung dengan AI features', 'stock' => 30, 'image' => 'samsungs24.jpg', 'price' => 17999000, 'product_category_id' => 1],
            ['name' => 'MacBook Air M3', 'slug' => 'macbook-air-m3', 'description' => 'Laptop tipis dan ringan dari Apple dengan chip M3', 'stock' => 15, 'image' => 'macbookair.jpg', 'price' => 16999000, 'product_category_id' => 1],
            ['name' => 'Sony WH-1000XM5', 'slug' => 'sony-wh1000xm5', 'description' => 'Headphone noise cancelling terbaik dari Sony', 'stock' => 40, 'image' => 'sonyxm5.jpg', 'price' => 4999000, 'product_category_id' => 1],
            ['name' => 'iPad Pro M4', 'slug' => 'ipad-pro-m4', 'description' => 'Tablet premium Apple dengan layar OLED dan chip M4', 'stock' => 20, 'image' => 'ipadpro.jpg', 'price' => 15499000, 'product_category_id' => 1],
            ['name' => 'ASUS ROG Strix G16', 'slug' => 'asus-rog-strix-g16', 'description' => 'Laptop gaming performa tinggi dengan RTX 4070', 'stock' => 12, 'image' => 'rogstrix.jpg', 'price' => 21999000, 'product_category_id' => 1],
            ['name' => 'LG OLED C4 55 inch', 'slug' => 'lg-oled-c4-55', 'description' => 'TV OLED 55 inch dengan Dolby Vision dan webOS', 'stock' => 10, 'image' => 'lgoled.jpg', 'price' => 14999000, 'product_category_id' => 1],
            ['name' => 'JBL Charge 5', 'slug' => 'jbl-charge-5', 'description' => 'Speaker portable tahan air dengan bass kuat', 'stock' => 50, 'image' => 'jblcharge5.jpg', 'price' => 2499000, 'product_category_id' => 1],
            ['name' => 'Logitech MX Master 3S', 'slug' => 'logitech-mx-master-3s', 'description' => 'Mouse wireless ergonomic untuk produktivitas', 'stock' => 35, 'image' => 'mxmaster.jpg', 'price' => 1299000, 'product_category_id' => 1],
            ['name' => 'Dell Monitor 27 4K', 'slug' => 'dell-monitor-27-4k', 'description' => 'Monitor 27 inch 4K UHD untuk desain dan kerja', 'stock' => 18, 'image' => 'dellmonitor.jpg', 'price' => 5499000, 'product_category_id' => 1],

            // ===== Kategori 2: Fashion (10) =====
            ['name' => 'Kaos Katun Premium', 'slug' => 'kaos-katun-premium', 'description' => 'Kaos katun 30s premium, nyaman dipakai sehari-hari', 'stock' => 100, 'image' => 'kaos.jpg', 'price' => 150000, 'product_category_id' => 2],
            ['name' => 'Jeans Slim Fit', 'slug' => 'jeans-slim-fit', 'description' => 'Celana jeans slim fit bahan premium stretch', 'stock' => 60, 'image' => 'jeans.jpg', 'price' => 350000, 'product_category_id' => 2],
            ['name' => 'Kemeja Flannel', 'slug' => 'kemeja-flannel', 'description' => 'Kemeja flannel motif kotak-kotak, bahan tebal', 'stock' => 45, 'image' => 'flannel.jpg', 'price' => 250000, 'product_category_id' => 2],
            ['name' => 'Hoodie Oversized', 'slug' => 'hoodie-oversized', 'description' => 'Hoodie oversized bahan fleece, hangat dan nyaman', 'stock' => 55, 'image' => 'hoodie.jpg', 'price' => 275000, 'product_category_id' => 2],
            ['name' => 'Chino Pants', 'slug' => 'chino-pants', 'description' => 'Celana chino formal/casual, bahan twill premium', 'stock' => 50, 'image' => 'chino.jpg', 'price' => 299000, 'product_category_id' => 2],
            ['name' => 'Jaket Denim', 'slug' => 'jaket-denim', 'description' => 'Jaket denim klasik, cocok untuk gaya kasual', 'stock' => 35, 'image' => 'jaketdenim.jpg', 'price' => 425000, 'product_category_id' => 2],
            ['name' => 'Sneakers Canvas', 'slug' => 'sneakers-canvas', 'description' => 'Sneakers canvas ringan dan nyaman untuk sehari-hari', 'stock' => 80, 'image' => 'sneakers.jpg', 'price' => 225000, 'product_category_id' => 2],
            ['name' => 'Dress Floral', 'slug' => 'dress-floral', 'description' => 'Dress bermotif bunga, bahan flowy dan adem', 'stock' => 40, 'image' => 'dress.jpg', 'price' => 325000, 'product_category_id' => 2],
            ['name' => 'Celana Jogger', 'slug' => 'celana-jogger', 'description' => 'Jogger pants bahan cotton fleece, nyaman beraktifitas', 'stock' => 70, 'image' => 'jogger.jpg', 'price' => 199000, 'product_category_id' => 2],
            ['name' => 'Topi Baseball', 'slug' => 'topi-baseball', 'description' => 'Topi baseball adjustable, bahan twill', 'stock' => 90, 'image' => 'topi.jpg', 'price' => 89000, 'product_category_id' => 2],

            // ===== Kategori 3: Makanan & Minuman (10) =====
            ['name' => 'Kopi Arabica Toraja', 'slug' => 'kopi-arabica-toraja', 'description' => 'Kopi Arabica premium dari Toraja, roast medium', 'stock' => 80, 'image' => 'kopi.jpg', 'price' => 125000, 'product_category_id' => 3],
            ['name' => 'Madu Hutan Asli', 'slug' => 'madu-hutan-asli', 'description' => 'Madu murni dari hutan Kalimantan, tanpa campuran', 'stock' => 50, 'image' => 'madu.jpg', 'price' => 175000, 'product_category_id' => 3],
            ['name' => 'Sambal Nusantara', 'slug' => 'sambal-nusantara', 'description' => 'Sambal homemade dengan cabai pilihan, pedas nikmat', 'stock' => 100, 'image' => 'sambal.jpg', 'price' => 45000, 'product_category_id' => 3],
            ['name' => 'Teh Oolong Premium', 'slug' => 'teh-oolong-premium', 'description' => 'Teh Oolong dari dataran tinggi, aroma harum', 'stock' => 60, 'image' => 'tehoolong.jpg', 'price' => 89000, 'product_category_id' => 3],
            ['name' => 'Keripik Singkong Balado', 'slug' => 'keripik-singkong-balado', 'description' => 'Keripik singkong renyah dengan bumbu balado pedas', 'stock' => 120, 'image' => 'keripik.jpg', 'price' => 35000, 'product_category_id' => 3],
            ['name' => 'Cokelat Bubuk Premium', 'slug' => 'cokelat-bubuk-premium', 'description' => 'Cokelat bubuk organik untuk minuman dan baking', 'stock' => 45, 'image' => 'cokelat.jpg', 'price' => 65000, 'product_category_id' => 3],
            ['name' => 'Madu Klengkeng', 'slug' => 'madu-klengkeng', 'description' => 'Madu klengkeng murni dari peternakan lokal', 'stock' => 35, 'image' => 'maduklengkeng.jpg', 'price' => 145000, 'product_category_id' => 3],
            ['name' => 'Roti Gandum Sehat', 'slug' => 'roti-gandum-sehat', 'description' => 'Roti gandum utuh tanpa pengawet, tinggi serat', 'stock' => 80, 'image' => 'rotigandum.jpg', 'price' => 28000, 'product_category_id' => 3],
            ['name' => 'Granola Homemade', 'slug' => 'granola-homemade', 'description' => 'Granola homemade dengan oats, madu, dan kacang', 'stock' => 55, 'image' => 'granola.jpg', 'price' => 75000, 'product_category_id' => 3],
            ['name' => 'Juice Seledri Segar', 'slug' => 'juice-seledri-segar', 'description' => 'Sari seledri segar kemasan botol, tanpa gula', 'stock' => 40, 'image' => 'juiceseledri.jpg', 'price' => 32000, 'product_category_id' => 3],

            // ===== Kategori 4: Kesehatan (10) =====
            ['name' => 'Vitamin C 1000mg', 'slug' => 'vitamin-c-1000mg', 'description' => 'Suplemen vitamin C untuk daya tahan tubuh', 'stock' => 120, 'image' => 'vitc.jpg', 'price' => 85000, 'product_category_id' => 4],
            ['name' => 'Masker Kain 3 Ply', 'slug' => 'masker-kain-3ply', 'description' => 'Masker kain 3 lapis, bisa dicuci dan dipakai ulang', 'stock' => 200, 'image' => 'masker.jpg', 'price' => 25000, 'product_category_id' => 4],
            ['name' => 'Hand Sanitizer 500ml', 'slug' => 'hand-sanitizer-500ml', 'description' => 'Hand sanitizer gel 70% alkohol, membunuh kuman', 'stock' => 150, 'image' => 'sanitizer.jpg', 'price' => 35000, 'product_category_id' => 4],
            ['name' => 'Termometer Digital', 'slug' => 'termometer-digital', 'description' => 'Termometer digital infrared, pengukuran cepat akurat', 'stock' => 60, 'image' => 'termometer.jpg', 'price' => 175000, 'product_category_id' => 4],
            ['name' => 'Istirahat Omega 3', 'slug' => 'omega-3', 'description' => 'Suplemen minyak ikan omega-3 untuk kesehatan jantung', 'stock' => 80, 'image' => 'omega3.jpg', 'price' => 125000, 'product_category_id' => 4],
            ['name' => 'Obat Gigi Herbal', 'slug' => 'obat-gigi-herbal', 'description' => 'Obat gigi herbal alami untuk gusi dan gigi sehat', 'stock' => 45, 'image' => 'obatgigi.jpg', 'price' => 45000, 'product_category_id' => 4],
            ['name' => 'Tensimeter Digital', 'slug' => 'tensimeter-digital', 'description' => 'Alat ukur tekanan darah digital, mudah digunakan', 'stock' => 30, 'image' => 'tensimeter.jpg', 'price' => 325000, 'product_category_id' => 4],
            ['name' => 'Plester Luka Premium', 'slug' => 'plester-luka-premium', 'description' => 'Plester luka waterproof, steril dan fleksibel', 'stock' => 100, 'image' => 'plester.jpg', 'price' => 18000, 'product_category_id' => 4],
            ['name' => 'Vitamin D3 2000 IU', 'slug' => 'vitamin-d3-2000iu', 'description' => 'Suplemen vitamin D3 untuk tulang dan imun', 'stock' => 90, 'image' => 'vitd.jpg', 'price' => 95000, 'product_category_id' => 4],
            ['name' => 'Minyak Kayu Putih', 'slug' => 'minyak-kayu-putih', 'description' => 'Minyak kayu putih alami, meredakan masuk angin', 'stock' => 110, 'image' => 'minyakkayuputih.jpg', 'price' => 28000, 'product_category_id' => 4],

            // ===== Kategori 5: Olahraga (10) =====
            ['name' => 'Yoga Mat Anti Slip', 'slug' => 'yoga-mat-anti-slip', 'description' => 'Matras yoga anti slip, tebal 6mm, bahan TPE', 'stock' => 35, 'image' => 'yoga.jpg', 'price' => 299000, 'product_category_id' => 5],
            ['name' => 'Dumbbell Set 5kg', 'slug' => 'dumbbell-set-5kg', 'description' => 'Set dumbbell adjustable 5kg per pasang', 'stock' => 25, 'image' => 'dumbbell.jpg', 'price' => 350000, 'product_category_id' => 5],
            ['name' => 'Sepatu Lari Nike', 'slug' => 'sepatu-lari-nike', 'description' => 'Sepatu lari ringan dengan teknologi Air cushion', 'stock' => 40, 'image' => 'nikelari.jpg', 'price' => 1499000, 'product_category_id' => 5],
            ['name' => 'Resistance Band Set', 'slug' => 'resistance-band-set', 'description' => 'Set resistance band 5 level, untuk strength training', 'stock' => 50, 'image' => 'resband.jpg', 'price' => 175000, 'product_category_id' => 5],
            ['name' => 'Bola Basket Molten', 'slug' => 'bola-basket-molten', 'description' => 'Bola basket resmi ukuran 7, bahan PU leather', 'stock' => 30, 'image' => 'bolabasket.jpg', 'price' => 375000, 'product_category_id' => 5],
            ['name' => 'Jump Rope Speed', 'slug' => 'jump-rope-speed', 'description' => 'Tali skipping speed untuk cardio dan warm up', 'stock' => 60, 'image' => 'jumprope.jpg', 'price' => 85000, 'product_category_id' => 5],
            ['name' => 'Kettlebell 10kg', 'slug' => 'kettlebell-10kg', 'description' => 'Kettlebell cast iron 10kg, cocok untuk functional training', 'stock' => 20, 'image' => 'kettlebell.jpg', 'price' => 425000, 'product_category_id' => 5],
            ['name' => 'Gym Gloves', 'slug' => 'gym-gloves', 'description' => 'Sarung tangan gym anti slip, bahan breathable', 'stock' => 45, 'image' => 'gymgloves.jpg', 'price' => 125000, 'product_category_id' => 5],
            ['name' => 'Raket Badminton Yonex', 'slug' => 'raket-badminton-yonex', 'description' => 'Raket badminton Yonex lightweight, untuk pemula', 'stock' => 25, 'image' => 'raket.jpg', 'price' => 350000, 'product_category_id' => 5],
            ['name' => 'Foam Roller', 'slug' => 'foam-roller', 'description' => 'Foam roller untuk recovery otot dan stretch', 'stock' => 35, 'image' => 'foamroller.jpg', 'price' => 165000, 'product_category_id' => 5],

            // ===== Kategori 6: Rumah Tangga (10) =====
            ['name' => 'Blender Multifungsi', 'slug' => 'blender-multifungsi', 'description' => 'Blender 3in1 untuk jus, smoothie, dan food processor', 'stock' => 40, 'image' => 'blender.jpg', 'price' => 450000, 'product_category_id' => 6],
            ['name' => 'Set Panci Stainless', 'slug' => 'set-panci-stainless', 'description' => 'Set panci stainless steel 5 pcs, anti karat', 'stock' => 30, 'image' => 'panci.jpg', 'price' => 375000, 'product_category_id' => 6],
            ['name' => 'Mesin Cuci Mini', 'slug' => 'mesin-cuci-mini', 'description' => 'Mesin cuci portable 3kg, hemat tempat dan listrik', 'stock' => 15, 'image' => 'mesincuci.jpg', 'price' => 1999000, 'product_category_id' => 6],
            ['name' => 'Rice Cooker Digital', 'slug' => 'rice-cooker-digital', 'description' => 'Rice cooker multifungsi dengan menu nasi goreng', 'stock' => 25, 'image' => 'ricecooker.jpg', 'price' => 850000, 'product_category_id' => 6],
            ['name' => 'Set Sapu Pel', 'slug' => 'set-sapu-pel', 'description' => 'Set sapu dan pel lengkap, gagang stainless', 'stock' => 55, 'image' => 'sapupel.jpg', 'price' => 125000, 'product_category_id' => 6],
            ['name' => 'Organizer Drawer', 'slug' => 'organizer-drawer', 'description' => 'Pengatur laci serbaguna, muat peralatan makan', 'stock' => 45, 'image' => 'organizer.jpg', 'price' => 75000, 'product_category_id' => 6],
            ['name' => 'Tempat Sampah Sortir', 'slug' => 'tempat-sampah-sortir', 'description' => 'Tempat sampah 3 warna untuk pilah organik/anorganik', 'stock' => 30, 'image' => 'tempatsampah.jpg', 'price' => 195000, 'product_category_id' => 6],
            ['name' => 'Gantungan Baju 10 pcs', 'slug' => 'gantungan-baju', 'description' => 'Gantungan baju anti slip, bahan velvet', 'stock' => 80, 'image' => 'gantungan.jpg', 'price' => 55000, 'product_category_id' => 6],
            ['name' => 'Set Pisau Dapur', 'slug' => 'set-pisau-dapur', 'description' => 'Set pisau dapur 6 pcs, stainless steel tajam', 'stock' => 20, 'image' => 'pisaudapur.jpg', 'price' => 275000, 'product_category_id' => 6],
            ['name' => 'Hanger Kabinet', 'slug' => 'hanger-kabinet', 'description' => 'Hanger gantung untuk jilbab dan aksesoris', 'stock' => 65, 'image' => 'hangerkabinet.jpg', 'price' => 35000, 'product_category_id' => 6],

            // ===== Kategori 7: Aksesoris (10) =====
            ['name' => 'Tas Ransel Laptop', 'slug' => 'tas-ransel-laptop', 'description' => 'Tas ransel anti air dengan slot laptop 15.6 inch', 'stock' => 55, 'image' => 'tas.jpg', 'price' => 225000, 'product_category_id' => 7],
            ['name' => 'Jam Tangan Digital', 'slug' => 'jam-tangan-digital', 'description' => 'Jam tangan digital sport, water resistant 50m', 'stock' => 45, 'image' => 'jam.jpg', 'price' => 299000, 'product_category_id' => 7],
            ['name' => 'Kacamata Blue Light', 'slug' => 'kacamata-blue-light', 'description' => 'Kacamata anti radiasi blue light untuk kerja depan layar', 'stock' => 60, 'image' => 'kacamata.jpg', 'price' => 175000, 'product_category_id' => 7],
            ['name' => 'Dompet Kulit Pria', 'slug' => 'dompet-kulit-pria', 'description' => 'Dompet kulit asli pria, model slim dan elegan', 'stock' => 40, 'image' => 'dompet.jpg', 'price' => 250000, 'product_category_id' => 7],
            ['name' => 'Gelang Tangan Wanita', 'slug' => 'gelang-tangan-wanita', 'description' => 'Gelang tangan sterling silver untuk hadiah', 'stock' => 35, 'image' => 'gelang.jpg', 'price' => 199000, 'product_category_id' => 7],
            ['name' => 'Sling Bag Canvas', 'slug' => 'sling-bag-canvas', 'description' => 'Tas selempang canvas vintage, cocok jalan-jalan', 'stock' => 50, 'image' => 'slingbag.jpg', 'price' => 149000, 'product_category_id' => 7],
            ['name' => 'Case HP Silicone', 'slug' => 'case-hp-silicone', 'description' => 'Case HP bahan silicone lembut, anti jatuh', 'stock' => 100, 'image' => 'casehp.jpg', 'price' => 49000, 'product_category_id' => 7],
            ['name' => 'Dompet Kartu Minimalis', 'slug' => 'dompet-kartu-minimalis', 'description' => 'Dompet kartu kecil, muat 8 kartu', 'stock' => 70, 'image' => 'dompetkartu.jpg', 'price' => 85000, 'product_category_id' => 7],
            ['name' => 'Headphone Pouch', 'slug' => 'headphone-pouch', 'description' => 'Pouch pelindung headphone, bahan EVA anti benturan', 'stock' => 40, 'image' => 'headphonepouch.jpg', 'price' => 79000, 'product_category_id' => 7],
            ['name' => 'Key Holder Mini', 'slug' => 'key-holder-mini', 'description' => 'Tempat kunci portable, ringan dan praktis', 'stock' => 80, 'image' => 'keyholder.jpg', 'price' => 35000, 'product_category_id' => 7],

            // ===== Kategori 8: Buku (10) =====
            ['name' => 'Atomic Habits', 'slug' => 'atomic-habits', 'description' => 'Buku best seller tentang membangun kebiasaan baik', 'stock' => 70, 'image' => 'atomic.jpg', 'price' => 65000, 'product_category_id' => 8],
            ['name' => 'Laskar Pelangi', 'slug' => 'laskar-pelangi', 'description' => 'Novel karya Andrea Hirata, cerita inspiratif', 'stock' => 90, 'image' => 'laskar.jpg', 'price' => 55000, 'product_category_id' => 8],
            ['name' => 'Bumi Manusia', 'slug' => 'bumi-manusia', 'description' => 'Novel karya Pramoedya Ananta Toer', 'stock' => 65, 'image' => 'bumi.jpg', 'price' => 75000, 'product_category_id' => 8],
            ['name' => 'Filosofi Teras', 'slug' => 'filosofi-teras', 'description' => 'Buku tentang stoicisme untuk kehidupan modern', 'stock' => 55, 'image' => 'filosofiteras.jpg', 'price' => 58000, 'product_category_id' => 8],
            ['name' => 'Rich Dad Poor Dad', 'slug' => 'rich-dad-poor-dad', 'description' => 'Buku klasik tentang literasi keuangan', 'stock' => 80, 'image' => 'richdad.jpg', 'price' => 72000, 'product_category_id' => 8],
            ['name' => 'Pulang', 'slug' => 'pulang', 'description' => 'Novel karya Tere Liye, petualangan seru', 'stock' => 45, 'image' => 'pulang.jpg', 'price' => 68000, 'product_category_id' => 8],
            ['name' => 'Negeri 5 Menara', 'slug' => 'negeri-5-menara', 'description' => 'Novel inspiratif tentang perjuangan menuntut ilmu', 'stock' => 60, 'image' => 'negeri5.jpg', 'price' => 62000, 'product_category_id' => 8],
            ['name' => 'The Psychology of Money', 'slug' => 'psychology-of-money', 'description' => 'Buku tentang psikologi keputusan keuangan', 'stock' => 50, 'image' => 'psychmoney.jpg', 'price' => 78000, 'product_category_id' => 8],
            ['name' => 'Hujan', 'slug' => 'hujan', 'description' => 'Novel karya Tere Liye, cerita tentang harapan', 'stock' => 75, 'image' => 'hujan.jpg', 'price' => 65000, 'product_category_id' => 8],
            ['name' => 'Sapiens', 'slug' => 'sapiens', 'description' => 'Buku tentang sejarah umat manusia dari Yuval Harari', 'stock' => 40, 'image' => 'sapiens.jpg', 'price' => 85000, 'product_category_id' => 8],
        ];

        foreach ($products as $product) {
            \App\Models\Products::firstOrCreate(
                ['slug' => $product['slug']],
                $product
            );
        }
    }
}
