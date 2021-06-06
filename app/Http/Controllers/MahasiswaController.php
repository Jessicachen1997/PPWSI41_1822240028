<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;


class MahasiswasController extends Controller
{
    public function insert()
    {
        $result = DB::insert('insert into mahasiswas (npm, nama_mahasiswa, tempat_lahir, tanggal_lahir,
        alamat, created_at) values (?, ?, ?, ?, ?, ?)',['1822240091','Jessica','Palembang',
        '1999-11-20','bukit besar', now()]);
        dump($result);
    }
    public function update()
    {
        $result = DB::update('update mahasiswas set nama_mahasiswa = "Ali", 
        updated_at = now() where npm = ?', ['1822240091']);
        dump($result);
    }

    public function delete()
    {
        $result = DB::delete('delete from mahasiswas where npm = ?', ['1822240091']);
        dump($result);
    }

    public function select()
    {
        $kampus = "Universitas Multi Data Palembang";
        $result = DB::select('select * from mahasiswas');
        // dump($result);
        return view('mahasiswa.index', ['allmahasiswa' => $result, 'kampus' => $kampus]);
    }
    public function insertQb()
    {
        $result = DB::table('mahasiswas')->insert(
            [
                'npm' => '1822240051',
                'nama_mahasiswa' => 'jokowi widodo',
                'tempat_lahir' =>'jakarta',
                'tanggal_lahir' =>'1999-02-10',
                'alamat' =>'Jl. Dempo',
                'created_at' => now()
            ]
            );
            dump($result);
    }

    public function updateQb()
    {
        $result = DB::table('mahasiswas')
            ->where('npm','1822240051')
            ->update(
                [
                    'nama_mahasiswa' => 'ujang',
                    'updated_at' => now()
                ]
                );
            dump($result);
    }

    public function deleteQb()
    {
        $result = DB::table('mahasiswas')
            ->where('npm','=','1822240051')
            ->delete();
        dump($result);
    }
    public function selectQb()
    {
        $kampus ="Universitas Multi Data Palembang";
        $result = DB::table('mahasiswas')->get();
        //dump($result);
        return view('mahasiswa.index',['allmahasiswa'=> $result, 'kampus' => $kampus]);
    }
    public function insertElq()
    {
        $mahasiswa = new Mahasiswa; //instansiasi class Mahasiswa
        $mahasiswa->npm ='1822240054';
        $mahasiswa->nama_mahasiswa ='Zainalabidin';
        $mahasiswa->tempat_lahir ='Surakarta';
        $mahasiswa->tanggal_lahir = '2001-11-11';
        $mahasiswa->alamat ='Jl Bambang Pamungkas';
        $mahasiswa->save();
        dump($mahasiswa);
    }
    public function updateElq()
    {
    $mahasiswa = Mahasiswa::where('npm','1822240054')->first(); //cari data tabel mahasiswas berdasarkan npm
        $mahasiswa->nama_mahasiswa='Susanti';
        $mahasiswa->save(); //menyimpan data ke tabel mahasiswas
        dump($mahasiswa); //melihat isi $mahasiswa
    }
    public function deleteElq()
    {
        $mahasiswa = Mahasiswa::where('npm', '1822240054')->first();//cari data tabel mahasiswas berdasarkan npm
        $mahasiswa->delete(); //hapus data npm 1822240052
        dump($mahasiswa); //melihat isi $mahasiswa
    }
    public function selectElq()
    {
        $kampus ="Universitas Multi Data Palembang";
        $mahasiswa = Mahasiswa::all();
        // dump ($allmahasiswa);
        return view('mahasiswa.index',['allmahasiswa'=>$mahasiswa,'kampus'=>$kampus]);
    }
}