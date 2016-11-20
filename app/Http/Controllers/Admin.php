<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Requests;
use PDF;
use Excel; 
setlocale(LC_ALL, 'id_ID', 'Indonesian_indonesia', 'Indonesian');
class Admin extends Controller
{
	private $tahun;
	private $reg;
	public function __construct()
    {
		$this->tahun='2016';
		$this->reg='4516';

	}
	public function index()
	{
		return $this->beranda();
	}
	
	public function beranda(Request $request)
	{
		if(session()->get('login')!=1 || session()->get('level')!='admin')
		{
			return view('public/beranda');
	        Session::flush();
			return false;
		}
		else
		{	
			$unit=DB::table('tbl_unit')
			->select('tbl_unit.*')
			->orderBy('id')
			->get();
			session(['menu' => 'beranda']);
			return view('admin/beranda',compact('unit'));
		}
	}
	public function list_kegiatan(Request $request)
	{
		if(session()->get('login')!=1 || session()->get('level')!='admin')
		{
			return view('public/beranda');
	        Session::flush();
			return false;
		}
		else
		{	
			$param=$request->input('param');
			$id=$request->input('id');
			$tahun=session()->get('tahun');
			if($param=='unit')
			{
				$unit=DB::table('tbl_unit')
					->select('tbl_unit.*')
					->where(['id'=>$id])
					->first();
				$kegiatan=DB::table('mst_kegiatan')
					->select('mst_kegiatan.*')
					->orderBy('mst_kegiatan.id')
					->where(['mst_kegiatan.unit'=>$id,'mst_kegiatan.tahun'=>$tahun])
					->get();
				//~ return 'Unit';
				return view('admin/kegiatan',compact('kegiatan','tahun','unit'));
			}
		}
	}
	public function cetak(Request $request)
	{
		$param=$request->input('param');
		$id=$request->input('id');
		$tahun=session()->get('tahun');
		if($param=="unit_tahun1")
		{
			$file=md5($param.date('Ymdhis'));

			$data=DB::table('mst_kegiatan')
				->select('mst_kegiatan.*')
				->orderBy('id')
				->where(['tahun'=>$tahun,'unit'=>$id])
				->get();
			$unit=DB::table('tbl_unit')
				->select('tbl_unit.*')
				->where(['id'=>$id])
				->first();
			PDF::AddPage('P');
			//~ PDF::SetMargins(10, 5, 5, 5, true);
			PDF::SetAutoPageBreak(TRUE, 0);
			PDF::setPrintFooter(false);
			PDF::SetFooterMargin(0);
			PDF::setPrintHeader(false);
			PDF::writeHTML(view('user/cetak/tahun1',compact('data','tahun','unit')), true, false, false, false, '');
			PDF::Output($_SERVER['DOCUMENT_ROOT']."e-planning/public/download/".$file.".pdf","F");
			echo '<u><a href="../../../e-planning/public/download/'.$file.'.pdf" download target="_blank">Generate laporan berhasil dibuat, download disini</a></u>';
		}
		if($param=="unit_tahun0")
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
	public function cetak_detail_peserta(Request $request)
	{
		$username=$request->input("username");
		$param=$request->input("param");
		$file=md5($param.date('Ymdhis'));
			$user=DB::table('mst_user')
				->select('mst_user.*')
				->where('username',$username)
				->first();
			$formasi=DB::table('mst_formasi')
				->select('mst_formasi.*','tbl_formasi_detail.nama_formasi')
				->leftJoin('tbl_formasi_detail', 'mst_formasi.id_formasi_detail', '=', 'tbl_formasi_detail.id')
				->where(['username'=>$username])
				->first();
			$bio=DB::table('mst_biodata')
				->select('mst_biodata.*')
				->where('username',$username)
				->first();
			$kel=DB::table('mst_keluarga')
				->select('mst_keluarga.*')
				->where('username',$username)
				->first();
			$akademik=DB::table('mst_akademik')
				->select('mst_akademik.*')
				->orderBy('jenjang')
				->where('username',$username)
				->get();
			PDF::AddPage('P');
			//~ PDF::SetMargins(10, 5, 5, 5, true);
			PDF::SetAutoPageBreak(TRUE, 0);
			PDF::setPrintFooter(false);
			PDF::SetFooterMargin(0);
			PDF::setPrintHeader(false);
			PDF::writeHTML(view('user/cetak/registrasi',compact('user','formasi','bio','kel','akademik')), true, false, false, false, '');
			PDF::Output($_SERVER['DOCUMENT_ROOT']."rekrutmen/public/download/".$file.".pdf","F");
			echo 'Sukses generate laporan, download <a href="../download/'.$file.'.pdf" download>disini.</a>';
	}
	public function logout()
	{
        Session::flush();
		header("Cache-Control","no-cache,no-store, must-revalidate");
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
        return redirect('/beranda');
        
	} 

}
