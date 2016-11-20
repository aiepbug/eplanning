<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Requests;
use App\Mst_kegiatan;
use App\Mst_kegiatan_rincian;
use PDF;
use Excel; 
class User extends Controller
{

	public function index()
	{
		return $this->beranda();
	}
	
	public function beranda(Request $request)
	{
		if(session()->get('login')!=1 && session()->get('level')!='user')
		{
			return view('public/beranda');
	        Session::flush();
			return false;
		}
		else
		{	
			return view('user/beranda');
		}
	}
	public function menu_cetak(Request $request)
	{
		$param=$request->input('param');
		if($param=="tahun1")
		{
			$file=md5($param.date('Ymdhis'));

			$data=DB::table('mst_kegiatan')
				->select('mst_kegiatan.*')
				->orderBy('id')
				->where(['tahun'=>session()->get('tahun'),'unit'=>session()->get('unit')])
				->get();
			$unit=DB::table('tbl_unit')
				->select('tbl_unit.*')
				->where(['id'=>session()->get('unit')])
				->first();
			$tahun=session()->get('tahun');
			PDF::AddPage('P');
			//~ PDF::SetMargins(10, 5, 5, 5, true);
			PDF::SetAutoPageBreak(TRUE, 0);
			PDF::setPrintFooter(false);
			PDF::SetFooterMargin(0);
			PDF::setPrintHeader(false);
			PDF::writeHTML(view('user/cetak/tahun1',compact('data','tahun','unit')), true, false, false, false, '');
			PDF::Output($_SERVER['DOCUMENT_ROOT']."e-planning/public/download/".$file.".pdf","F");
			echo 'Generate laporan berhasil dibuat, download <a href="../../../e-planning/public/download/'.$file.'.pdf" download target="_blank">disini</a>';
		}
		if($param=="tahun0")
		{
			$file=md5($param.date('Ymdhis'));

			$data=DB::table('mst_kegiatan')
				->select('mst_kegiatan.*')
				->orderBy('id')
				->where(['tahun'=>session()->get('tahun'),'unit'=>session()->get('unit')])
				->get();
			$unit=DB::table('tbl_unit')
				->select('tbl_unit.*')
				->where(['id'=>session()->get('unit')])
				->first();
			$tahun=session()->get('tahun');
			PDF::AddPage('P');
			//~ PDF::SetMargins(10, 5, 5, 5, true);
			PDF::SetAutoPageBreak(TRUE, 0);
			PDF::setPrintFooter(false);
			PDF::SetFooterMargin(0);
			PDF::setPrintHeader(false);
			PDF::writeHTML(view('user/cetak/tahun1',compact('data','tahun','unit')), true, false, false, false, '');
			PDF::Output($_SERVER['DOCUMENT_ROOT']."e-planning/public/download/".$file.".pdf","F");
			echo 'Generate laporan berhasil dibuat, download <a href="../../../e-planning/public/download/'.$file.'.pdf" download target="_blank">disini</a>';
		}
		else
		{
			return '';
		}
	}
	
	public function input_data(Request $request)
	{
		$tahun=$request->input('tahun');
		if(session()->get('login')!=1 && session()->get('level')!='user')
		{
			return view('public/beranda');
	        Session::flush();
			return false;
		}
		else
		{
			session(['tahun' => $tahun]);
			$kegiatan=DB::table('mst_kegiatan')
				->select('mst_kegiatan.*')
				->orderBy('mst_kegiatan.id')
				->where(['mst_kegiatan.unit'=>session()->get('unit'),'mst_kegiatan.tahun'=>$tahun])
				->get();
			return view('user/kegiatan',compact('kegiatan','tahun'));
		}
	}
	public function rincian_kegiatan(Request $a,$_token,$id)
	{
		$id=$request->input('id');
		if(session()->get('login')!=1 && session()->get('level')!='user')
		{
			return view('public/beranda');
	        Session::flush();
			return false;
		}
		else
		{
			$kegiatan=DB::table('mst_kegiatan_rincian')
				->select('mst_kegiatan_rincian.*')
				->orderBy('mst_kegiatan_rincian.id')
				->where(['id_kegiatan'=>$id])
				->get();
			return 'Ok';
		}
	}
	public function editKegiatan(Request $request)
	{
		$id=$request->input('id');
		if(session()->get('login')!=1 && session()->get('level')!='user')
		{
			return view('public/beranda');
	        Session::flush();
			return false;
		}
		else
		{
			$kegiatan=DB::table('mst_kegiatan')
					->select('mst_kegiatan.*')
					->orderBy('mst_kegiatan.id')
					->where(['id'=>$id])
					->first();
			return view('user/modal_tambah_kegiatan',compact('kegiatan'));
		}
	}
	public function editRincian(Request $request)
	{
		$id=$request->input('id');
		if(session()->get('login')!=1 && session()->get('level')!='user')
		{
			return view('public/beranda');
	        Session::flush();
			return false;
		}
		else
		{
			$rincian=DB::table('mst_kegiatan_rincian')
					->select('mst_kegiatan_rincian.*')
					->where(['id'=>$id])
					->first();
			$kegiatan=DB::table('mst_kegiatan')
					->select('mst_kegiatan.*')
					->orderBy('mst_kegiatan.id')
					->where(['id'=>$rincian->id_kegiatan])
					->first();
			$satuan=DB::table('tbl_satuan')
					->select('tbl_satuan.*')
					->orderBy('tbl_satuan.nama_satuan')
					->where(['aktif'=>1])
					->get();
			return view('user/modal_tambah_rincian',compact('kegiatan','satuan','rincian'));
		}
	}
	public function tambahKegiatan(Request $request)
	{
		if(session()->get('login')!=1 && session()->get('level')!='user')
		{
			return view('public/beranda');
	        Session::flush();
			return false;
		}
		else
		{
			return view('user/modal_tambah_kegiatan');
		}
	}
	public function tambahRincian(Request $request)
	{
		$id=$request->input('id');
		if(session()->get('login')!=1 && session()->get('level')!='user')
		{
			return view('public/beranda');
	        Session::flush();
			return false;
		}
		else
		{
			$kegiatan=DB::table('mst_kegiatan')
					->select('mst_kegiatan.*')
					->orderBy('mst_kegiatan.id')
					->where(['id'=>$id])
					->first();
			$satuan=DB::table('tbl_satuan')
					->select('tbl_satuan.*')
					->orderBy('tbl_satuan.nama_satuan')
					->where(['aktif'=>1])
					->get();
			return view('user/modal_tambah_rincian',compact('kegiatan','satuan'));
		}
	}
	
	public function simpan_kegiatan(Request $request)
	{
		if(session()->get('login')!=1 && session()->get('level')!='user')
		{
			return view('public/beranda');
	        Session::flush();
			return false;
		}
		else
		{
			$param=$request->input('param');
			$id=$request->input('id');
			$kegiatan=$request->input('kegiatan');
			$tahun=session()->get('tahun');
			$unit=session()->get('unit');
			if($param=='simpan')
			{
				DB::table('mst_kegiatan')->insert([
					'nama_kegiatan'=>$kegiatan,
					'tahun'=>$tahun,
					'unit'=>$unit
				]);
			}
			else if($param=='update')
			{
				DB::table('mst_kegiatan')->where('id',$id)->update(array(
					'nama_kegiatan'=>$kegiatan
				));
			}				
			$kegiatan=DB::table('mst_kegiatan')
				->select('mst_kegiatan.*')
				->orderBy('mst_kegiatan.id')
				->where(['mst_kegiatan.unit'=>session()->get('unit'),'mst_kegiatan.tahun'=>$tahun])
				->get();
			return view('user/kegiatan',compact('kegiatan','tahun'));
		}
	}
	public function simpan_rincian(Request $request)
	{
		if(session()->get('login')!=1 && session()->get('level')!='user')
		{
			return view('public/beranda');
	        Session::flush();
			return false;
		}
		else
		{
			$param=$request->input('param');
			$id=$request->input('id');
			$id_rincian=$request->input('id_rincian');
			$keterangan=$request->input('keterangan');
			$harga=$request->input('harga');
			$jumlah1=$request->input('nilai1');
			$satuan1=$request->input('satuan1');
			$jumlah2=$request->input('nilai2');
			$satuan2=$request->input('satuan2');
			$jumlah3=$request->input('nilai3');
			$satuan3=$request->input('satuan3');
			if($param=='simpan')
			{
				DB::table('mst_kegiatan_rincian')->insert([
					'id_kegiatan'=>$id,
					'rincian_kegiatan'=>$keterangan,
					'harga'=>$harga,
					'jumlah1'=>$jumlah1,
					'satuan1'=>$satuan1,
					'jumlah2'=>$jumlah2,
					'satuan2'=>$satuan2,
					'jumlah3'=>$jumlah3,
					'satuan3'=>$satuan3
				]);
			}
			else if($param=='update')
			{
				DB::table('mst_kegiatan_rincian')->where('id',$id_rincian)->update(array(
					'rincian_kegiatan'=>$keterangan,
					'harga'=>$harga,
					'jumlah1'=>$jumlah1,
					'satuan1'=>$satuan1,
					'jumlah2'=>$jumlah2,
					'satuan2'=>$satuan2,
					'jumlah3'=>$jumlah3,
					'satuan3'=>$satuan3
				));
			}				
			$detil=DB::table('mst_kegiatan')->select('*')->where(['id'=>$id])->first();
			$tahun=$detil->tahun;
			$kegiatan=DB::table('mst_kegiatan')
				->select('mst_kegiatan.*')
				->orderBy('mst_kegiatan.id')
				->where(['mst_kegiatan.unit'=>session()->get('unit'),'mst_kegiatan.tahun'=>$tahun])
				->get();
			return view('user/kegiatan',compact('kegiatan','tahun'));
		}
	}
	public function hapus_rincian(Request $request)
	{
		if(session()->get('login')!=1 && session()->get('level')!='user')
		{
			return view('public/beranda');
	        Session::flush();
			return false;
		}
		else
		{
			$id=$request->input('id');
			$id_keg=DB::table('mst_kegiatan_rincian')->select('*')->where(['id'=>$id])->first();
			$detil=DB::table('mst_kegiatan')->select('*')->where(['id'=>$id_keg->id_kegiatan])->first();
			$tahun=$detil->tahun;
			DB::table('mst_kegiatan_rincian')->where('id','=',$id)->delete();
			$kegiatan=DB::table('mst_kegiatan')
				->select('mst_kegiatan.*')
				->orderBy('mst_kegiatan.id')
				->where(['mst_kegiatan.unit'=>session()->get('unit'),'mst_kegiatan.tahun'=>$tahun])
				->get();
			return view('user/kegiatan',compact('kegiatan','tahun'));
		}
	}
	public function hapus_kegiatan(Request $request)
	{
		if(session()->get('login')!=1 && session()->get('level')!='user')
		{
			return view('public/beranda');
	        Session::flush();
			return false;
		}
		else
		{
			$id=$request->input('id');
			$tahun=session()->get('tahun');
			DB::table('mst_kegiatan')->where('id','=',$id)->delete();
			DB::table('mst_kegiatan_rincian')->where('id_kegiatan','=',$id)->delete();
			
			$kegiatan=DB::table('mst_kegiatan')
				->select('mst_kegiatan.*')
				->orderBy('mst_kegiatan.id')
				->where(['mst_kegiatan.unit'=>session()->get('unit'),'mst_kegiatan.tahun'=>$tahun])
				->get();
			return view('user/kegiatan',compact('kegiatan','tahun'));
		}
	}
	public function logout()
	{
        Session::flush();
		header("Cache-Control","no-cache,no-store, must-revalidate");
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
        return redirect('/beranda');
        
	} 
	Public function ubahpw()
	{
		if(session()->get('login')!=1)
		{
			return view('public/beranda');
			return false;
		}
		else
		{
			return view('user/ubahpw');
		}
	}
	Public function simpanpw(Request $request)
	{
		if(session()->get('login')!=1)
		{
			return view('public/beranda');
			return false;
		}
		else
		{
			$passl=$request->input('passl');
			$passb=$request->input('passb');
			$passbr=$request->input('passbr');
			$cek=DB::table('mst_user')
					->select('mst_keluarga.*')
					->where(['username'=>session()->get('username'),'password'=>$passl])
					->count();
			if($cek>0)
			{
				DB::table('mst_user')
					->where(['username'=>session()->get('username')])
					->update(['password'=>$passb]);
				return "<span class='green-text text-darken-1'>Berhasil ubah password</span>";
			}
			else
			{
				return "<span class='red-text text-darken-1'>Password lama salah!</span>";
			}
		}
	}

}
