<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengembalian;
use App\Models\Pengajuan;
use App\Models\User;
use App\Models\Barang;
use Carbon\Carbon;

class PengembalianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengajuans = Pengajuan::where('status', 'approved')->get();

        foreach ($pengajuans as $pengajuan) {
            Pengembalian::create([
                'user_id' => $pengajuan->user_id,
                'barang_id' => $pengajuan->barang_id,
                'pengajuan_id' => $pengajuan->id,
                'tanggal_pengembalian' => Carbon::now()->subDays(rand(1, 15)),
                'status' => collect(['pending', 'approved', 'rejected'])->random(),
            ]);
        }
    }
}
