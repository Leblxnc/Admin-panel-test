<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permohonan extends Model
{
    protected $table = ('permohonan');
    protected $primaryKey = ('pm_id');
    protected $fillable = ['jenis_permohonan','ktp','skck','suket_desa','foto','surat_permohonan','ijazah_terakhir','bukti_transfer_PNBP','keterangan', 'user_id'];
    public function user(){
        return $this->belongsTo(user::class, 'user_id');
    }
}
