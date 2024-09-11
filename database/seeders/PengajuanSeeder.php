<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengajuan;
use App\Models\User;
use App\Models\Barang;
use Carbon\Carbon;

class PengajuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $barangs = Barang::all();

        foreach ($users as $user) {
            foreach ($barangs as $barang) {
                Pengajuan::create([
                    'user_id' => $user->id,
                    'barang_id' => $barang->id,
                    'tanggal_pengajuan' => Carbon::now()->subDays(rand(1, 30)),
                    'status' => collect(['pending', 'approved', 'rejected'])->random(),
                ]);
            }
        }
    }
}
