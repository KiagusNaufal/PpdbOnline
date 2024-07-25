<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Student extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    protected $table = 'students';

    // Relasi ke tabel lain (opsional)
    public function pendaftaran()
    {
        return [
            'id' => $this->id,
            'nama_lengkap' => $this->nama_lengkap,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'alamat' => $this->alamat,
            'no_kk' => $this->no_kk,
            'nik' => $this->nik,
            'Nisn' => $this->Nisn,

        ];
    }
}
