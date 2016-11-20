<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Requests;
use App\Mst_user;

class Publik extends Controller
{
	//~ public function __construct()
	//~ {
		//~ $this->middleware('auth');
	//~ }
	public function index()
	{
		
	}
	public function ceklogin(Request $request)
	{
		$username=$request->input('username');
		$password=$request->input('password');
		$tahun=$request->input('tahun');
		$cek=DB::table('mst_user')
					->select('mst_user.*')
					->where(['username'=>$username,'password'=>$password])
					->count();
		if($cek>0)
		{
			$user=DB::table('mst_user')
					->select('mst_user.*')
					->where(['username'=>$username,'password'=>$password])
					->first();
			$level=$user->level;
			if($user->aktif==1 && $user->level=='user')
			{
				session(['username' => $username,'level'=>$level,'nama'=>$user->nama,'unit'=>$user->unit,'login'=>1,'tahun'=>$tahun]);
				return 'user';
			}
			else if($user->aktif==1 && $user->level=='admin')
			{
				session(['username' => $username,'level'=>$level,'nama'=>$user->nama,'unit'=>$user->unit,'login'=>1,'tahun'=>$tahun]);
				return 'admin';
			}
			else if($user->aktif==0)
			{
				return 'expired';
			}
			else
			{
				return 'false';
			}
		}
		else
		{
			return 'false';
		}
	}
	public function xregister(Request $request)
	{
		$email=$request->input('email');
		$nik=$request->input('nik');
		$nama=$request->input('nama');
		$cek_email=DB::table('mst_biodata')
					->select('mst_biodata.*')
					->where(['username'=>$email])
					->count();
		if($cek_email==0)
		{
			$cek_nik=DB::table('mst_biodata')
				->select('mst_biodata.*')
				->where(['nik'=>$nik])
				->count();
			if($cek_nik==0)
			{
				$simpan = new Mst_biodata;
				$simpan->nama = $nama;
				$simpan->username = $email;
				$simpan->nik = $nik;
				$simpan->save();
				$simpan = new Mst_user;
				$simpan->username = $email;
				$simpan->password = substr($nik,-5);
				$simpan->level = "user";
				$simpan->aktif = 1;
				$simpan->status = 0;
				$simpan->save();
				return "Berhasil, silahkan login menggunakan <br>username : ".$email." <br> password : *lima digit terakhir NIK* klik <a href='#login'>Login</a>";
			}
			else
			{
				return 'Error, NIK sudah pernah didafarkan <a onclick="regs()" href="#register">coba lagi</a>';
			}
		}
		else
		{
			return 'Error, email sudah pernah didafarkan <a onclick="regs()" href="#register">coba lagi</a>';
		}
	}
	Public function news(Request $request)
	{
		$id=$request->input('id');
		$news=DB::table('mst_berita')
					->select('mst_berita.*')
					->where(['id'=>$id])
					->first();
		return view('publik/news',compact('news'));
	}
	Public function regs(Request $request)
	{
		return view('publik/regs');
	} 
}
