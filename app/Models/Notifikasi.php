<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $attributes = [
        'mark' => 'false'
    ];
    public function user()
    {
        return $this->belongsToMany(User::class,'notifikasis_users');
    }
    public static function notif($tb, $msg, $jn, $st, )
    {
        return [
                'nama_table' => $tb,
                'msg' => $msg,
                'jenis_notifikasi' => $jn,
                'status' => $st
        ];
    }
}
