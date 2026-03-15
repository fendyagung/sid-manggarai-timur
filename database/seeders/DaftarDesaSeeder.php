<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DaftarDesaSeeder extends Seeder
{
    public function run(): void
    {
        $villages = [
            // Borong (15 Desa)
            ['kecamatan' => 'Borong', 'nama' => 'Balus Permai', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Bangka Kantar', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Benteng Raja', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Benteng Riwu', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Compang Ndejing', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Compang Tenda', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Golo Kantar', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Golo Lalong', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Golo Leda', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Gurung Liwut', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Nanga Labang', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Ngampang Mas', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Poco Rii', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Rana Masak', 'type' => 'Desa'],
            ['kecamatan' => 'Borong', 'nama' => 'Waling', 'type' => 'Desa'],

            // Lamba Leda Selatan (21 Desa)
            ['kecamatan' => 'Lamba Leda Selatan', 'nama' => 'Bangka Kuleng', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Selatan', 'nama' => 'Bangka Pau', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Selatan', 'nama' => 'Bea Waek', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Selatan', 'nama' => 'Compang Laho', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Selatan', 'nama' => 'Compang Wesang', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Selatan', 'nama' => 'Compang Weluk', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Selatan', 'nama' => 'Deno', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Selatan', 'nama' => 'Golo Lobos', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Selatan', 'nama' => 'Golo Ndari', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Selatan', 'nama' => 'Golo Nderu', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Selatan', 'nama' => 'Golo Rengket', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Selatan', 'nama' => 'Golo Wune', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Selatan', 'nama' => 'Gurung Turi', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Selatan', 'nama' => 'Lenang', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Selatan', 'nama' => 'Lento', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Selatan', 'nama' => 'Leong', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Selatan', 'nama' => 'Melo', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Selatan', 'nama' => 'Poco Lia', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Selatan', 'nama' => 'Pocong', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Selatan', 'nama' => 'Satar Tesem', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Selatan', 'nama' => 'Watu Lanur', 'type' => 'Desa'],

            // Lamba Leda (13 Desa)
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Compang Deru', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Compang Mekar', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Compang Necak', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Goreng Meni', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Goreng Meni Utara', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Golo Lembur', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Golo Munga', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Golo Nimbung', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Golo Paleng', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Golo Rentung', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Lamba Keli', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Tengku Lawar', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda', 'nama' => 'Tengku Leda', 'type' => 'Desa'],

            // Lamba Leda Utara (11 Desa)
            ['kecamatan' => 'Lamba Leda Utara', 'nama' => 'Golo Mangung', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Utara', 'nama' => 'Golo Munga Barat', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Utara', 'nama' => 'Golo Wontong', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Utara', 'nama' => 'Haju Wangi', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Utara', 'nama' => 'Lencur', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Utara', 'nama' => 'Liang Deruk', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Utara', 'nama' => 'Nampar Tabang', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Utara', 'nama' => 'Satar Kampas', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Utara', 'nama' => 'Satar Padut', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Utara', 'nama' => 'Satar Punda', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Utara', 'nama' => 'Satar Punda Barat', 'type' => 'Desa'],

            // Sambi Rampas (6 Desa)
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Kembang Mekar', 'type' => 'Desa'],
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Lada Mese', 'type' => 'Desa'],
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Nampar Sepang', 'type' => 'Desa'],
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Nanga Mbaling', 'type' => 'Desa'],
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Nanga Mbaur', 'type' => 'Desa'],
            ['kecamatan' => 'Sambi Rampas', 'nama' => 'Wela Lada', 'type' => 'Desa'],

            // Congkar (8 Desa)
            ['kecamatan' => 'Congkar', 'nama' => 'Buti', 'type' => 'Desa'],
            ['kecamatan' => 'Congkar', 'nama' => 'Golo Ngawan', 'type' => 'Desa'],
            ['kecamatan' => 'Congkar', 'nama' => 'Satar Nawang', 'type' => 'Desa'],
            ['kecamatan' => 'Congkar', 'nama' => 'Rana Mese', 'type' => 'Desa'],
            ['kecamatan' => 'Congkar', 'nama' => 'Compang Congkar', 'type' => 'Desa'],
            ['kecamatan' => 'Congkar', 'nama' => 'Compang Lawi', 'type' => 'Desa'],
            ['kecamatan' => 'Congkar', 'nama' => 'Golo Pari', 'type' => 'Desa'],
            ['kecamatan' => 'Congkar', 'nama' => 'Wea', 'type' => 'Desa'],

            // Elar (14 Desa)
            ['kecamatan' => 'Elar', 'nama' => 'Biting', 'type' => 'Desa'],
            ['kecamatan' => 'Elar', 'nama' => 'Compang Soba', 'type' => 'Desa'],
            ['kecamatan' => 'Elar', 'nama' => 'Compang Teo', 'type' => 'Desa'],
            ['kecamatan' => 'Elar', 'nama' => 'Golo Lebo', 'type' => 'Desa'],
            ['kecamatan' => 'Elar', 'nama' => 'Golo Lijun', 'type' => 'Desa'],
            ['kecamatan' => 'Elar', 'nama' => 'Golo Munde', 'type' => 'Desa'],
            ['kecamatan' => 'Elar', 'nama' => 'Haju Ngendong', 'type' => 'Desa'],
            ['kecamatan' => 'Elar', 'nama' => 'Kaju Wangi', 'type' => 'Desa'],
            ['kecamatan' => 'Elar', 'nama' => 'Legur Lai', 'type' => 'Desa'],
            ['kecamatan' => 'Elar', 'nama' => 'Lengko Namut', 'type' => 'Desa'],
            ['kecamatan' => 'Elar', 'nama' => 'Rana Gapang', 'type' => 'Desa'],
            ['kecamatan' => 'Elar', 'nama' => 'Rana Kulan', 'type' => 'Desa'],
            ['kecamatan' => 'Elar', 'nama' => 'Sisir', 'type' => 'Desa'],
            ['kecamatan' => 'Elar', 'nama' => 'Wae Lokom', 'type' => 'Desa'],

            // Kota Komba (19 Desa)
            ['kecamatan' => 'Kota Komba', 'nama' => 'Bamo', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Golo Meni', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Golo Ndele', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Golo Nderu', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Golo Tolang', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Gunung', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Gunung Baru', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Komba', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Lembur', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Mbengan', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Mokel', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Mokel Morid', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Paan Leleng', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Pari', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Pong Ruan', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Rana Kolong', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Rana Mbeling', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Rana Mbata', 'type' => 'Desa'],
            ['kecamatan' => 'Kota Komba', 'nama' => 'Ruan', 'type' => 'Desa'],

            // Rana Mese (21 Desa)
            ['kecamatan' => 'Rana Mese', 'nama' => 'Bangka Kempo', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Bangka Masa', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Bea Ngencung', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Compang Kantar', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Compang Kempo', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Compang Loni', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Compang Teber', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Golo Loni', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Golo Meleng', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Golo Ros', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Golo Rutuk', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Lalang', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Lidi', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Rondo Woing', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Sano Lokom', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Satar Lahing', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Satar Lenda', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Sita', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Torok Golo', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Wae Nggori', 'type' => 'Desa'],
            ['kecamatan' => 'Rana Mese', 'nama' => 'Watu Mori', 'type' => 'Desa'],

            // Lamba Leda Timur (18 Desa)
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Arus', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Bangka Arus', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Benteng Rampas', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Benteng Wunis', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Colol', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Compang Raci', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Compang Wunis', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Golo Lero', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Ngkiong Dora', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Rende Nao', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Rengkam', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Tango Molas', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Ulu Wae', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Urung Dora', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Wangkar Weli', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Watu Arus', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Wejang Mali', 'type' => 'Desa'],
            ['kecamatan' => 'Lamba Leda Timur', 'nama' => 'Wejang Mawe', 'type' => 'Desa'],

            // Elar Selatan (13 Desa)
            ['kecamatan' => 'Elar Selatan', 'nama' => 'Benteng Pau', 'type' => 'Desa'],
            ['kecamatan' => 'Elar Selatan', 'nama' => 'Gising', 'type' => 'Desa'],
            ['kecamatan' => 'Elar Selatan', 'nama' => 'Golo Linus', 'type' => 'Desa'],
            ['kecamatan' => 'Elar Selatan', 'nama' => 'Golo Wuas', 'type' => 'Desa'],
            ['kecamatan' => 'Elar Selatan', 'nama' => 'Langga Sai', 'type' => 'Desa'],
            ['kecamatan' => 'Elar Selatan', 'nama' => 'Mosi Ngaran', 'type' => 'Desa'],
            ['kecamatan' => 'Elar Selatan', 'nama' => 'Nanga Meje', 'type' => 'Desa'],
            ['kecamatan' => 'Elar Selatan', 'nama' => 'Nanga Puun', 'type' => 'Desa'],
            ['kecamatan' => 'Elar Selatan', 'nama' => 'Paan Waru', 'type' => 'Desa'],
            ['kecamatan' => 'Elar Selatan', 'nama' => 'Sangan Kalo', 'type' => 'Desa'],
            ['kecamatan' => 'Elar Selatan', 'nama' => 'Sipi', 'type' => 'Desa'],
            ['kecamatan' => 'Elar Selatan', 'nama' => 'Teno Mese', 'type' => 'Desa'],
            ['kecamatan' => 'Elar Selatan', 'nama' => 'Wae Rasan', 'type' => 'Desa'],
        ];

        foreach ($villages as $v) {
            $email = strtolower(str_replace(' ', '', $v['nama'] . '.' . $v['kecamatan'])) . '@desa.com';
            
            // Create or update the User account for the village
            $user = User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => 'Admin ' . $v['type'] . ' ' . $v['nama'],
                    'password' => Hash::make('password'),
                    'role' => 'admin_desa',
                    'kecamatan' => $v['kecamatan']
                ]
            );

            // Update or insert the Desa record with the user_id
            DB::table('desas')->updateOrInsert(
                ['nama_desa' => $v['nama'], 'kecamatan' => $v['kecamatan']],
                [
                    'user_id' => $user->id,
                    'created_at' => now(), 
                    'updated_at' => now()
                ]
            );
        }
    }
}
