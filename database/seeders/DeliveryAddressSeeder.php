<?php

namespace Database\Seeders;

use App\Models\Shop\OrderCity;
use App\Models\Shop\OrderDistrict;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districtsAndCities = [
            'Dhaka' => [
                'Dhaka City' => 10.00,
                'Savar' => 10.00,
                'Gazipur' => 8.00,
                'Narayanganj' => 9.50,
                'Tangail' => 7.50,
                'Manikganj' => 8.75,
                'Munshiganj' => 9.00,
                'Narsingdi' => 8.50,
                'Kishoreganj' => 8.25,
                'Rajbari' => 7.75,
                'Shariatpur' => 8.50,

            ],
            'Chittagong' => [
                'Chittagong City' => 12.00,
                'Comilla' => 10.00,
                'Cox\'s Bazar' => 15.50,
                'Feni' => 11.25,
                'Rangamati' => 14.00,
                'Khagrachari' => 13.50,
                'Bandarban' => 15.00,
                'Noakhali' => 12.50,
                'Lakshmipur' => 12.25,

            ],
            'Khulna' => [
                'Khulna City' => 11.00,
                'Jessore' => 9.00,
                'Satkhira' => 10.50,
                'Bagerhat' => 8.75,
                'Jhenaidah' => 9.50,
                'Magura' => 8.25,
                'Narail' => 7.75,
                'Chuadanga' => 8.00,

            ],
            'Rajshahi' => [
                'Rajshahi City' => 11.50,
                'Bogra' => 10.00,
                'Pabna' => 10.50,
                'Natore' => 9.75,
                'Sirajganj' => 9.25,

            ],
            'Barisal' => [
                'Barisal City' => 11.00,
                'Patuakhali' => 9.50,
                'Bhola' => 10.00,
                'Pirojpur' => 8.75,
                'Jhalokathi' => 8.25,

            ],
            'Sylhet' => [
                'Sylhet City' => 12.50,
                'Moulvibazar' => 11.00,
                'Habiganj' => 11.50,
                'Sunamganj' => 10.75,

            ],
            'Rangpur' => [
                'Rangpur City' => 12.00,
                'Dinajpur' => 10.50,
                'Kurigram' => 11.00,
                'Gaibandha' => 9.75,
                'Lalmonirhat' => 9.25,

            ],
            'Mymensingh' => [
                'Mymensingh City' => 11.50,
                'Jamalpur' => 10.00,
                'Netrokona' => 10.50,
                'Sherpur' => 9.75,

            ],
        ];

        foreach ($districtsAndCities as $districtName => $cities) {
            $district = OrderDistrict::create(['name' => $districtName]);

            foreach ($cities as $cityName => $deliveryCharge) {
                OrderCity::create([
                    'name' => $cityName,
                    'order_district_id' => $district->id,
                    'delivery_charge' => $deliveryCharge,
                ]);
            }
        }
    }
}
