<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class datadiri extends Model
{
    protected $table = ('datadiri');
    protected $primaryKey = ('dr_id');
    protected $fillable = ['foto', 'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin','Agama', 'pendidikan_terakhir', 'scan_ijazah', 'alamat', 'no_telp', 'pekerjaan', 'kk', 'nomor_identitas', 'identitas', 'user_id'];
    
    
    
    public function user()
    {
        return $this->hasOne(User::class);
        $user = User::find(1);
        $datadiri = $user->datadiri;
    }
}
