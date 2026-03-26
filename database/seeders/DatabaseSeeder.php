<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@otakushop.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Cliente de prueba
        User::create([
            'name' => 'Cliente Test',
            'email' => 'cliente@test.com',
            'password' => bcrypt('password'),
            'role' => 'cliente',
        ]);

        // Categorias
        $figuras = Category::create(['name' => 'Figuras']);
        $manga = Category::create(['name' => 'Manga']);
        $ropa = Category::create(['name' => 'Ropa']);
        $accesorios = Category::create(['name' => 'Accesorios']);

        // Productos - Figuras
        $figurasProducts = [
            ['name' => 'Figura Goku Ultra Instinct', 'description' => 'Figura de coleccion de Goku en su forma Ultra Instinct. Altura: 25cm. Material PVC de alta calidad.', 'price' => 899.99, 'stock' => 15],
            ['name' => 'Figura Naruto Sage Mode', 'description' => 'Naruto Uzumaki en modo sabio. Base incluida. Altura: 20cm.', 'price' => 749.50, 'stock' => 10],
            ['name' => 'Figura Luffy Gear 5', 'description' => 'Monkey D. Luffy en su transformacion Gear 5. Edicion especial. Altura: 28cm.', 'price' => 1250.00, 'stock' => 5],
            ['name' => 'Figura Levi Ackerman', 'description' => 'Levi del escuadron de reconocimiento. Con espadas y equipo de maniobras tridimensional.', 'price' => 680.00, 'stock' => 20],
            ['name' => 'Figura Tanjiro Kamado', 'description' => 'Tanjiro con espada Nichirin. Posicion de combate. Altura: 22cm.', 'price' => 720.00, 'stock' => 12],
            ['name' => 'Figura Gojo Satoru', 'description' => 'Gojo Satoru de Jujutsu Kaisen. Detalle premium con ojos revelados. Altura: 24cm.', 'price' => 950.00, 'stock' => 8],
        ];

        foreach ($figurasProducts as $p) {
            Product::create(array_merge($p, ['category_id' => $figuras->id, 'active' => true]));
        }

        // Productos - Manga
        $mangaProducts = [
            ['name' => 'One Piece Tomo 1', 'description' => 'Romance Dawn - El inicio de la aventura de Luffy. Edicion en espanol.', 'price' => 149.00, 'stock' => 50],
            ['name' => 'Demon Slayer Box Set', 'description' => 'Coleccion completa de Kimetsu no Yaiba. 23 tomos en caja coleccionable.', 'price' => 3200.00, 'stock' => 3],
            ['name' => 'Jujutsu Kaisen Tomo 1', 'description' => 'El inicio de Yuji Itadori en el mundo de la hechiceria. Edicion en espanol.', 'price' => 149.00, 'stock' => 35],
            ['name' => 'My Hero Academia Tomo 1', 'description' => 'Izuku Midoriya y su camino para ser heroe. Edicion en espanol.', 'price' => 139.00, 'stock' => 40],
            ['name' => 'Chainsaw Man Tomo 1', 'description' => 'Denji y Pochita, el inicio de una historia brutal. Edicion en espanol.', 'price' => 149.00, 'stock' => 30],
            ['name' => 'Dragon Ball Super Tomo 1', 'description' => 'La continuacion de la saga. Akira Toriyama y Toyotaro. Edicion en espanol.', 'price' => 155.00, 'stock' => 25],
        ];

        foreach ($mangaProducts as $p) {
            Product::create(array_merge($p, ['category_id' => $manga->id, 'active' => true]));
        }

        // Productos - Ropa
        $ropaProducts = [
            ['name' => 'Camiseta Akatsuki', 'description' => 'Camiseta negra con estampado de nubes rojas de Akatsuki. 100% algodon. Tallas S-XL.', 'price' => 350.00, 'stock' => 30],
            ['name' => 'Hoodie Attack on Titan', 'description' => 'Sudadera con capucha del Escuadron de Reconocimiento. Color verde militar.', 'price' => 650.00, 'stock' => 15],
            ['name' => 'Camiseta One Piece Jolly Roger', 'description' => 'Camiseta con el simbolo pirata de los Sombrero de Paja. Algodon premium.', 'price' => 320.00, 'stock' => 25],
            ['name' => 'Hoodie Jujutsu Kaisen', 'description' => 'Sudadera negra con el logo de la Escuela Tecnica Superior de Hechiceria de Tokyo.', 'price' => 690.00, 'stock' => 12],
            ['name' => 'Camiseta Dragon Ball Z', 'description' => 'Camiseta con diseno de la armadura Saiyan. Estampado completo. Tallas S-XXL.', 'price' => 380.00, 'stock' => 20],
        ];

        foreach ($ropaProducts as $p) {
            Product::create(array_merge($p, ['category_id' => $ropa->id, 'active' => true]));
        }

        // Productos - Accesorios
        $accesoriosProducts = [
            ['name' => 'Llavero Espada Nichirin', 'description' => 'Llavero metalico de la espada de Tanjiro. 10cm de largo. Acabado detallado.', 'price' => 89.00, 'stock' => 50],
            ['name' => 'Poster Naruto Shippuden', 'description' => 'Poster oficial de Naruto Shippuden. Tamano 60x90cm. Papel fotografico.', 'price' => 120.00, 'stock' => 40],
            ['name' => 'Collar Sharingan', 'description' => 'Collar con dije del Sharingan giratorio. Cadena de acero inoxidable.', 'price' => 150.00, 'stock' => 35],
            ['name' => 'Mousepad XXL Anime', 'description' => 'Mousepad extendido 80x30cm con diseno anime. Base antideslizante.', 'price' => 250.00, 'stock' => 20],
            ['name' => 'Bandana Konoha', 'description' => 'Bandana metalica de la Aldea Oculta de la Hoja. Tela azul ajustable.', 'price' => 180.00, 'stock' => 25],
            ['name' => 'Taza Gamer Anime', 'description' => 'Taza ceramica 350ml con disenos de anime populares. Apta para microondas.', 'price' => 199.00, 'stock' => 30],
        ];

        foreach ($accesoriosProducts as $p) {
            Product::create(array_merge($p, ['category_id' => $accesorios->id, 'active' => true]));
        }
    }
}
