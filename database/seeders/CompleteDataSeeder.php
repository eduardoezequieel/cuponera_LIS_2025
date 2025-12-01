<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CompleteDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('🌱 Iniciando seed completo de la base de datos...');

        // Asegurar que los roles existen
        $this->command->info('📋 Creando roles...');
        $roles = ['admin', 'empresa', 'cliente'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Crear empresas
        $this->command->info('🏢 Creando empresas...');
        $empresas = [
            [
                'name' => 'Pizza Hut',
                'company_name' => 'Pizza Hut El Salvador',
                'email' => 'contacto@pizzahut.sv',
                'nit' => '0614-290465-101-9',
                'phone' => '22221111',
                'address' => 'Blvd. del Hipódromo, San Salvador',
            ],
            [
                'name' => 'Burger King',
                'company_name' => 'Burger King Corporation SV',
                'email' => 'info@burgerking.sv',
                'nit' => '0614-180356-102-4',
                'phone' => '22223333',
                'address' => 'Centro Comercial La Gran Vía, Antiguo Cuscatlán',
            ],
            [
                'name' => 'Cinépolis',
                'company_name' => 'Cinépolis El Salvador',
                'email' => 'atencion@cinepolis.sv',
                'nit' => '0614-150789-103-5',
                'phone' => '22224444',
                'address' => 'Multiplaza, San Salvador',
            ],
            [
                'name' => 'Gimnasio Fitness Pro',
                'company_name' => 'Fitness Pro SV',
                'email' => 'info@fitnesspro.sv',
                'nit' => '0614-120456-104-6',
                'phone' => '22225555',
                'address' => 'Col. Escalón, San Salvador',
            ],
            [
                'name' => 'Restaurante El Bodegón',
                'company_name' => 'El Bodegón S.A. de C.V.',
                'email' => 'reservas@elbodegon.sv',
                'nit' => '0614-090123-105-7',
                'phone' => '22226666',
                'address' => 'Zona Rosa, San Salvador',
            ],
            [
                'name' => 'Pollo Campero',
                'company_name' => 'Campero El Salvador S.A.',
                'email' => 'info@campero.sv',
                'nit' => '0614-110588-106-8',
                'phone' => '22227777',
                'address' => 'Plaza Mundo, San Salvador',
            ],
            [
                'name' => 'Super Selectos',
                'company_name' => 'Super Selectos S.A. de C.V.',
                'email' => 'contacto@superselectos.sv',
                'nit' => '0614-080392-107-9',
                'phone' => '22228888',
                'address' => 'Col. San Benito, San Salvador',
            ],
            [
                'name' => 'La Curacao',
                'company_name' => 'Inversiones La Curacao S.A.',
                'email' => 'ventas@lacuracao.sv',
                'nit' => '0614-050690-108-0',
                'phone' => '22229999',
                'address' => 'Boulevard del Hipódromo, San Salvador',
            ],
            [
                'name' => 'Salón Elegance',
                'company_name' => 'Elegance Beauty S.A.',
                'email' => 'citas@elegance.sv',
                'nit' => '0614-030891-109-1',
                'phone' => '22230000',
                'address' => 'Paseo General Escalón, San Salvador',
            ],
            [
                'name' => 'AutoServicio Rápido',
                'company_name' => 'Talleres Rápido S.A. de C.V.',
                'email' => 'servicios@autorapido.sv',
                'nit' => '0614-071294-110-2',
                'phone' => '22231111',
                'address' => 'Autopista Sur, San Salvador',
            ],
            [
                'name' => 'Café Britt',
                'company_name' => 'Britt El Salvador S.A.',
                'email' => 'info@cafebritt.sv',
                'nit' => '0614-091593-111-3',
                'phone' => '22232222',
                'address' => 'Centro Comercial La Gran Vía, San Salvador',
            ],
            [
                'name' => 'Farmacia San Nicolás',
                'company_name' => 'Farmacia San Nicolás S.A.',
                'email' => 'atencion@sannicolas.sv',
                'nit' => '0614-041288-112-4',
                'phone' => '22233333',
                'address' => 'Col. Flor Blanca, San Salvador',
            ],
            [
                'name' => 'Pet Paradise',
                'company_name' => 'Pet Paradise El Salvador S.A.',
                'email' => 'info@petparadise.sv',
                'nit' => '0614-061791-113-5',
                'phone' => '22234444',
                'address' => 'Centro Comercial Galerías, San Salvador',
            ],
            [
                'name' => 'Spa Relax Total',
                'company_name' => 'Relax Total Wellness S.A.',
                'email' => 'reservas@relaxtotal.sv',
                'nit' => '0614-020995-114-6',
                'phone' => '22235555',
                'address' => 'Col. San Francisco, San Salvador',
            ],
            [
                'name' => 'Librería Nacional',
                'company_name' => 'Librería Nacional El Salvador',
                'email' => 'ventas@librerianacional.sv',
                'nit' => '0614-100892-115-7',
                'phone' => '22236666',
                'address' => 'Plaza Las Américas, Santa Tecla',
            ],
        ];

        $empresasCreadas = [];
        $commissions = [12.00, 10.00, 15.00, 8.00, 10.00, 11.00, 9.00, 13.00, 14.00, 10.00, 12.00, 9.50, 11.50, 13.50, 10.50];
        foreach ($empresas as $index => $empresaData) {
            $empresa = User::firstOrCreate(
                ['email' => $empresaData['email']],
                array_merge($empresaData, [
                    'username' => strtolower(str_replace(' ', '', $empresaData['name'])),
                    'password' => Hash::make('password123'),
                    'company_approved' => true,
                    'commission_percentage' => $commissions[$index] ?? 10.00,
                ])
            );
            if (!$empresa->hasRole('empresa')) {
                $empresa->assignRole('empresa');
            }
            $empresasCreadas[] = $empresa;
            $this->command->info("  ✓ {$empresa->company_name}");
        }

        // Crear cupones para cada empresa
        $this->command->info('🎟️  Creando cupones...');
        $cuponesData = [
            // Pizza Hut (4 cupones)
            [
                'title' => '2x1 Pizza Familiar',
                'description' => 'Compra una pizza familiar y lleva otra gratis. Válido para todas las pizzas del menú.',
                'regular_price' => 25.99,
                'offer_price' => 12.99,
                'quantity' => 50,
            ],
            [
                'title' => 'Combo Personal',
                'description' => 'Pizza personal + bebida + postre por un precio especial.',
                'regular_price' => 12.50,
                'offer_price' => 8.99,
                'quantity' => 100,
            ],
            [
                'title' => 'Pizza Grande + Alitas',
                'description' => 'Pizza grande de tu elección + orden de alitas BBQ o picantes.',
                'regular_price' => 22.00,
                'offer_price' => 15.99,
                'quantity' => 60,
            ],
            [
                'title' => 'Martes de Pizza',
                'description' => '50% de descuento en pizzas medianas todos los martes.',
                'regular_price' => 16.00,
                'offer_price' => 8.00,
                'quantity' => 80,
            ],
            // Burger King (4 cupones)
            [
                'title' => 'Whopper + Papas + Bebida',
                'description' => 'Combo completo Whopper con papas grandes y bebida de 20 oz.',
                'regular_price' => 8.99,
                'offer_price' => 5.99,
                'quantity' => 75,
            ],
            [
                'title' => '2 Whopper Jr por $5',
                'description' => 'Dos hamburguesas Whopper Jr por solo $5. Perfectas para compartir.',
                'regular_price' => 7.98,
                'offer_price' => 5.00,
                'quantity' => 60,
            ],
            [
                'title' => 'King Nuggets 20 Piezas',
                'description' => '20 nuggets crujientes + 2 salsas a elegir + papas medianas.',
                'regular_price' => 10.50,
                'offer_price' => 7.99,
                'quantity' => 90,
            ],
            [
                'title' => 'Desayuno Rey',
                'description' => 'Croissant de jamón y queso + hash browns + café o jugo.',
                'regular_price' => 6.50,
                'offer_price' => 4.99,
                'quantity' => 70,
            ],
            // Cinépolis (3 cupones)
            [
                'title' => 'Entrada + Combo de Palomitas',
                'description' => 'Entrada para cualquier función + combo de palomitas medianas y bebida.',
                'regular_price' => 15.00,
                'offer_price' => 10.00,
                'quantity' => 80,
            ],
            [
                'title' => '2 Entradas por $12',
                'description' => 'Dos entradas para cualquier película en cartelera.',
                'regular_price' => 16.00,
                'offer_price' => 12.00,
                'quantity' => 100,
            ],
            [
                'title' => 'Combo Familiar Completo',
                'description' => '4 entradas + 2 palomitas grandes + 4 bebidas + 2 hot dogs.',
                'regular_price' => 50.00,
                'offer_price' => 35.00,
                'quantity' => 40,
            ],
            // Fitness Pro (4 cupones)
            [
                'title' => 'Membresía 3 Meses',
                'description' => 'Acceso completo al gimnasio por 3 meses incluyendo clases grupales.',
                'regular_price' => 120.00,
                'offer_price' => 89.99,
                'quantity' => 30,
            ],
            [
                'title' => 'Pack 10 Clases Personalizadas',
                'description' => '10 sesiones de entrenamiento personalizado con instructor certificado.',
                'regular_price' => 150.00,
                'offer_price' => 99.99,
                'quantity' => 20,
            ],
            [
                'title' => 'Membresía Anual Premium',
                'description' => 'Acceso ilimitado por 12 meses + evaluación nutricional + plan de entrenamiento.',
                'regular_price' => 400.00,
                'offer_price' => 299.99,
                'quantity' => 15,
            ],
            [
                'title' => 'Clases de Yoga - 1 Mes',
                'description' => 'Clases ilimitadas de yoga y meditación por 30 días.',
                'regular_price' => 60.00,
                'offer_price' => 39.99,
                'quantity' => 50,
            ],
            // El Bodegón (3 cupones)
            [
                'title' => 'Cena para 2 Personas',
                'description' => 'Menú completo para dos personas: entrada, plato fuerte y postre.',
                'regular_price' => 45.00,
                'offer_price' => 32.99,
                'quantity' => 40,
            ],
            [
                'title' => 'Desayuno Buffet',
                'description' => 'Buffet de desayuno todos los fines de semana. Incluye bebidas ilimitadas.',
                'regular_price' => 18.00,
                'offer_price' => 12.99,
                'quantity' => 50,
            ],
            [
                'title' => 'Happy Hour 2x1',
                'description' => '2x1 en bebidas y entradas de 5pm a 7pm de lunes a viernes.',
                'regular_price' => 25.00,
                'offer_price' => 12.50,
                'quantity' => 70,
            ],
            // Pollo Campero (4 cupones)
            [
                'title' => 'Combo Familiar 12 Piezas',
                'description' => '12 piezas de pollo + papas familiares + ensalada + 4 tortillas + 1.5L refresco.',
                'regular_price' => 28.00,
                'offer_price' => 19.99,
                'quantity' => 60,
            ],
            [
                'title' => 'Campero Box Personal',
                'description' => '3 piezas de pollo + papas + bebida + pan.',
                'regular_price' => 8.50,
                'offer_price' => 6.49,
                'quantity' => 100,
            ],
            [
                'title' => 'Desayuno Típico',
                'description' => 'Huevos rancheros + frijoles + plátano + crema + pan francés + café.',
                'regular_price' => 7.00,
                'offer_price' => 4.99,
                'quantity' => 80,
            ],
            [
                'title' => 'Campero Sándwich Combo',
                'description' => 'Sándwich de pollo + papas + bebida + postre.',
                'regular_price' => 9.00,
                'offer_price' => 6.99,
                'quantity' => 75,
            ],
            // Super Selectos (3 cupones)
            [
                'title' => 'Cupón $20 en Compras',
                'description' => 'Descuento de $20 en compras mayores a $100. Válido en toda la tienda.',
                'regular_price' => 20.00,
                'offer_price' => 15.00,
                'quantity' => 200,
            ],
            [
                'title' => 'Frutas y Verduras 30% OFF',
                'description' => '30% de descuento en toda la sección de frutas y verduras frescas.',
                'regular_price' => 15.00,
                'offer_price' => 10.50,
                'quantity' => 150,
            ],
            [
                'title' => 'Despensa Básica',
                'description' => 'Kit con productos básicos: arroz, frijol, aceite, azúcar, sal a precio especial.',
                'regular_price' => 35.00,
                'offer_price' => 24.99,
                'quantity' => 100,
            ],
            // La Curacao (4 cupones)
            [
                'title' => '$50 en Electrodomésticos',
                'description' => 'Descuento de $50 en compra de electrodomésticos mayores a $300.',
                'regular_price' => 50.00,
                'offer_price' => 35.00,
                'quantity' => 80,
            ],
            [
                'title' => 'Celulares 20% Descuento',
                'description' => '20% de descuento en celulares seleccionados + protector de pantalla gratis.',
                'regular_price' => 100.00,
                'offer_price' => 80.00,
                'quantity' => 50,
            ],
            [
                'title' => 'Muebles para Sala',
                'description' => '15% de descuento en juegos de sala de 3 piezas o más.',
                'regular_price' => 200.00,
                'offer_price' => 170.00,
                'quantity' => 30,
            ],
            [
                'title' => 'Línea Blanca Especial',
                'description' => 'Refrigeradora + estufa + lavadora con descuento especial del 25%.',
                'regular_price' => 400.00,
                'offer_price' => 300.00,
                'quantity' => 20,
            ],
            // Salón Elegance (3 cupones)
            [
                'title' => 'Corte + Peinado + Manicure',
                'description' => 'Servicio completo de belleza: corte de cabello, peinado y manicure.',
                'regular_price' => 35.00,
                'offer_price' => 24.99,
                'quantity' => 60,
            ],
            [
                'title' => 'Tratamiento Capilar Premium',
                'description' => 'Hidratación profunda + keratina + corte + brushing.',
                'regular_price' => 80.00,
                'offer_price' => 59.99,
                'quantity' => 40,
            ],
            [
                'title' => 'Día de Spa',
                'description' => 'Facial + mascarilla + manicure + pedicure + masaje de 30 min.',
                'regular_price' => 65.00,
                'offer_price' => 45.00,
                'quantity' => 35,
            ],
            // AutoServicio Rápido (4 cupones)
            [
                'title' => 'Cambio de Aceite Completo',
                'description' => 'Cambio de aceite + filtro + revisión de 15 puntos + lavado gratis.',
                'regular_price' => 35.00,
                'offer_price' => 24.99,
                'quantity' => 100,
            ],
            [
                'title' => 'Alineación y Balanceo',
                'description' => 'Alineación computarizada + balanceo de 4 llantas + rotación.',
                'regular_price' => 45.00,
                'offer_price' => 32.99,
                'quantity' => 70,
            ],
            [
                'title' => 'Lavado Premium + Encerado',
                'description' => 'Lavado completo exterior e interior + encerado + pulido + aspirado profundo.',
                'regular_price' => 25.00,
                'offer_price' => 17.99,
                'quantity' => 120,
            ],
            [
                'title' => 'Revisión Pre-Vacacional',
                'description' => 'Chequeo completo de 25 puntos antes de tu viaje + reporte detallado.',
                'regular_price' => 40.00,
                'offer_price' => 29.99,
                'quantity' => 50,
            ],
            // Café Britt (3 cupones)
            [
                'title' => 'Desayuno Gourmet',
                'description' => 'Sandwich + ensalada de frutas + café specialty + jugo natural.',
                'regular_price' => 12.00,
                'offer_price' => 8.99,
                'quantity' => 90,
            ],
            [
                'title' => 'Café + Repostería',
                'description' => 'Café de tu elección + cualquier pastel o croissant.',
                'regular_price' => 7.50,
                'offer_price' => 5.49,
                'quantity' => 150,
            ],
            [
                'title' => 'Pack Café Premium 500g',
                'description' => 'Bolsa de café premium 500g + taza de cerámica de regalo.',
                'regular_price' => 18.00,
                'offer_price' => 13.99,
                'quantity' => 60,
            ],
            // Farmacia San Nicolás (4 cupones)
            [
                'title' => 'Cupón $10 en Medicamentos',
                'description' => 'Descuento de $10 en compras de medicamentos con receta mayores a $50.',
                'regular_price' => 10.00,
                'offer_price' => 7.00,
                'quantity' => 200,
            ],
            [
                'title' => 'Vitaminas y Suplementos 25% OFF',
                'description' => '25% de descuento en toda la línea de vitaminas y suplementos alimenticios.',
                'regular_price' => 20.00,
                'offer_price' => 15.00,
                'quantity' => 120,
            ],
            [
                'title' => 'Chequeo de Presión + Glucosa',
                'description' => 'Medición gratuita de presión arterial y glucosa + consulta con farmacéutico.',
                'regular_price' => 5.00,
                'offer_price' => 2.00,
                'quantity' => 250,
            ],
            [
                'title' => 'Kit de Primeros Auxilios',
                'description' => 'Kit completo con vendas, alcohol, termómetro, analgésicos y más.',
                'regular_price' => 25.00,
                'offer_price' => 17.99,
                'quantity' => 80,
            ],
            // Pet Paradise (3 cupones)
            [
                'title' => 'Baño y Corte para Mascotas',
                'description' => 'Baño completo + corte de pelo + limpieza de oídos + corte de uñas.',
                'regular_price' => 30.00,
                'offer_price' => 19.99,
                'quantity' => 70,
            ],
            [
                'title' => 'Alimento Premium 15kg',
                'description' => 'Saco de 15kg de alimento premium para perros o gatos + snacks gratis.',
                'regular_price' => 45.00,
                'offer_price' => 34.99,
                'quantity' => 60,
            ],
            [
                'title' => 'Consulta Veterinaria + Vacuna',
                'description' => 'Consulta general + vacuna antirrábica o parvovirus + desparasitación.',
                'regular_price' => 35.00,
                'offer_price' => 24.99,
                'quantity' => 50,
            ],
            // Spa Relax Total (4 cupones)
            [
                'title' => 'Masaje Relajante 60 min',
                'description' => 'Masaje de cuerpo completo con aceites aromáticos por 60 minutos.',
                'regular_price' => 45.00,
                'offer_price' => 32.99,
                'quantity' => 50,
            ],
            [
                'title' => 'Facial Anti-Edad',
                'description' => 'Limpieza facial profunda + mascarilla + serum anti-edad + hidratación.',
                'regular_price' => 55.00,
                'offer_price' => 39.99,
                'quantity' => 40,
            ],
            [
                'title' => 'Paquete de Pareja',
                'description' => 'Masaje relajante para 2 personas + jacuzzi + aromaterapia + vino.',
                'regular_price' => 120.00,
                'offer_price' => 89.99,
                'quantity' => 25,
            ],
            [
                'title' => 'Reflexología + Sauna',
                'description' => 'Sesión de reflexología podal + 30 minutos de sauna + té relajante.',
                'regular_price' => 35.00,
                'offer_price' => 24.99,
                'quantity' => 60,
            ],
            // Librería Nacional (3 cupones)
            [
                'title' => 'Cupón $15 en Libros',
                'description' => 'Descuento de $15 en compras de libros mayores a $50.',
                'regular_price' => 15.00,
                'offer_price' => 10.00,
                'quantity' => 100,
            ],
            [
                'title' => 'Kit Escolar Completo',
                'description' => 'Mochila + cuadernos + lápices + colores + reglas + todo para el colegio.',
                'regular_price' => 40.00,
                'offer_price' => 29.99,
                'quantity' => 80,
            ],
            [
                'title' => '3x2 en Bestsellers',
                'description' => 'Compra 2 libros bestsellers y lleva un tercero gratis de igual o menor valor.',
                'regular_price' => 30.00,
                'offer_price' => 20.00,
                'quantity' => 90,
            ],
        ];

        $cuponesCreados = [];
        $cuponesPerEmpresa = [4, 4, 3, 4, 3, 4, 3, 4, 3, 4, 3, 4, 3, 4, 3]; // Cantidad de cupones por empresa
        $index = 0;
        foreach ($empresasCreadas as $key => $empresa) {
            $cantidadCupones = $cuponesPerEmpresa[$key] ?? 3;
            for ($i = 0; $i < $cantidadCupones; $i++) {
                if (isset($cuponesData[$index])) {
                    $data = $cuponesData[$index];
                    $startDate = now()->subDays(rand(0, 10)); // Algunos cupones ya iniciados
                    $endDate = (clone $startDate)->addDays(rand(30, 90));
                    $redemptionDeadline = (clone $endDate)->addDays(rand(7, 15));

                    $coupon = Coupon::create([
                        'user_id' => $empresa->id,
                        'title' => $data['title'],
                        'description' => $data['description'],
                        'regular_price' => $data['regular_price'],
                        'offer_price' => $data['offer_price'],
                        'start_date' => $startDate,
                        'end_date' => $endDate,
                        'redemption_deadline' => $redemptionDeadline,
                        'quantity' => $data['quantity'],
                        'status' => 'available',
                    ]);
                    $cuponesCreados[] = $coupon;
                    $this->command->info("  ✓ {$coupon->title} - {$empresa->company_name}");
                }
                $index++;
            }
        }

        // Crear clientes
        $this->command->info('👥 Creando clientes...');
        $clientes = [
            [
                'name' => 'María',
                'lastname' => 'González',
                'email' => 'maria.gonzalez@email.com',
                'dui' => '012345678',
                'birth_date' => '1995-03-15',
            ],
            [
                'name' => 'Carlos',
                'lastname' => 'Martínez',
                'email' => 'carlos.martinez@email.com',
                'dui' => '023456789',
                'birth_date' => '1988-07-22',
            ],
            [
                'name' => 'Ana',
                'lastname' => 'Rodríguez',
                'email' => 'ana.rodriguez@email.com',
                'dui' => '034567890',
                'birth_date' => '1992-11-30',
            ],
            [
                'name' => 'José',
                'lastname' => 'Hernández',
                'email' => 'jose.hernandez@email.com',
                'dui' => '045678901',
                'birth_date' => '1990-05-18',
            ],
            [
                'name' => 'Laura',
                'lastname' => 'López',
                'email' => 'laura.lopez@email.com',
                'dui' => '056789012',
                'birth_date' => '1998-09-25',
            ],
            [
                'name' => 'Roberto',
                'lastname' => 'García',
                'email' => 'roberto.garcia@email.com',
                'dui' => '067890123',
                'birth_date' => '1985-12-10',
            ],
            [
                'name' => 'Patricia',
                'lastname' => 'Morales',
                'email' => 'patricia.morales@email.com',
                'dui' => '078901234',
                'birth_date' => '1993-02-28',
            ],
            [
                'name' => 'Fernando',
                'lastname' => 'Ramírez',
                'email' => 'fernando.ramirez@email.com',
                'dui' => '089012345',
                'birth_date' => '1987-06-14',
            ],
            [
                'name' => 'Gabriela',
                'lastname' => 'Castillo',
                'email' => 'gabriela.castillo@email.com',
                'dui' => '090123456',
                'birth_date' => '1996-04-12',
            ],
            [
                'name' => 'Miguel',
                'lastname' => 'Flores',
                'email' => 'miguel.flores@email.com',
                'dui' => '101234567',
                'birth_date' => '1991-08-08',
            ],
            [
                'name' => 'Sofía',
                'lastname' => 'Mejía',
                'email' => 'sofia.mejia@email.com',
                'dui' => '112345678',
                'birth_date' => '1994-01-20',
            ],
            [
                'name' => 'Diego',
                'lastname' => 'Ortiz',
                'email' => 'diego.ortiz@email.com',
                'dui' => '123456789',
                'birth_date' => '1989-10-05',
            ],
            [
                'name' => 'Valentina',
                'lastname' => 'Rivas',
                'email' => 'valentina.rivas@email.com',
                'dui' => '134567890',
                'birth_date' => '1997-06-18',
            ],
            [
                'name' => 'Andrés',
                'lastname' => 'Cruz',
                'email' => 'andres.cruz@email.com',
                'dui' => '145678901',
                'birth_date' => '1986-12-03',
            ],
            [
                'name' => 'Camila',
                'lastname' => 'Vásquez',
                'email' => 'camila.vasquez@email.com',
                'dui' => null,
                'birth_date' => '1999-09-14',
            ],
            [
                'name' => 'Ricardo',
                'lastname' => 'Salazar',
                'email' => 'ricardo.salazar@email.com',
                'dui' => '156789012',
                'birth_date' => '1984-03-27',
            ],
            [
                'name' => 'Isabella',
                'lastname' => 'Montes',
                'email' => 'isabella.montes@email.com',
                'dui' => null,
                'birth_date' => '2000-07-11',
            ],
            [
                'name' => 'Sebastián',
                'lastname' => 'Guzmán',
                'email' => 'sebastian.guzman@email.com',
                'dui' => '167890123',
                'birth_date' => '1993-05-22',
            ],
            [
                'name' => 'Natalia',
                'lastname' => 'Pérez',
                'email' => 'natalia.perez@email.com',
                'dui' => '178901234',
                'birth_date' => '1990-11-16',
            ],
            [
                'name' => 'Javier',
                'lastname' => 'Campos',
                'email' => 'javier.campos@email.com',
                'dui' => '189012345',
                'birth_date' => '1988-02-09',
            ],
        ];

        $clientesCreados = [];
        foreach ($clientes as $clienteData) {
            $cliente = User::firstOrCreate(
                ['email' => $clienteData['email']],
                array_merge($clienteData, [
                    'username' => strtolower($clienteData['name'] . $clienteData['lastname']),
                    'password' => Hash::make('password123'),
                ])
            );
            if (!$cliente->hasRole('cliente')) {
                $cliente->assignRole('cliente');
            }
            $clientesCreados[] = $cliente;
            $this->command->info("  ✓ {$cliente->name} {$cliente->lastname}");
        }

        // Crear compras
        $this->command->info('🛒 Creando compras...');
        $cardTypes = ['visa', 'mastercard', 'american_express'];
        $purchaseCount = 0;

        foreach ($clientesCreados as $cliente) {
            // Cada cliente compra entre 5 y 10 cupones
            $numCompras = rand(5, 10);
            $usedCoupons = []; // Evitar duplicados en el mismo día

            for ($i = 0; $i < $numCompras; $i++) {
                $coupon = $cuponesCreados[array_rand($cuponesCreados)];

                // Solo crear compra si hay stock disponible
                if ($coupon->quantity > 0) {
                    // Generar fecha de compra distribuida en los últimos 90 días
                    $daysAgo = rand(1, 90);
                    $purchaseDate = now()->subDays($daysAgo);

                    Purchase::create([
                        'user_id' => $cliente->id,
                        'coupon_id' => $coupon->id,
                        'purchase_date' => $purchaseDate,
                        'unique_code' => strtoupper(substr(md5(uniqid() . $purchaseCount), 0, 8)),
                        'payment_details' => [
                            'card_type' => $cardTypes[array_rand($cardTypes)],
                            'card_number' => '**** **** **** ' . rand(1000, 9999),
                            'cardholder_name' => $cliente->name . ' ' . $cliente->lastname,
                        ],
                    ]);

                    // Decrementar cantidad
                    $coupon->decrement('quantity');
                    $purchaseCount++;
                }
            }
        }
        $this->command->info("  ✓ Total de compras creadas: {$purchaseCount}");

        $this->command->info('');
        $this->command->info('✅ Seed completado exitosamente!');
        $this->command->info('');
        $this->command->info('📊 Resumen:');
        $this->command->info("   • Empresas: " . count($empresasCreadas));
        $this->command->info("   • Cupones: " . count($cuponesCreados));
        $this->command->info("   • Clientes: " . count($clientesCreados));
        $this->command->info("   • Compras: {$purchaseCount}");
        $this->command->info('');
        $this->command->info('🔑 Credenciales de acceso:');
        $this->command->info('   Admin: admin@admin.com / admin123');
        $this->command->info('   Empresas: [email de la empresa] / password123');
        $this->command->info('   Clientes: [email del cliente] / password123');
    }
}
