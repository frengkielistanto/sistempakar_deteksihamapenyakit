<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

class Konsultasi extends RestController {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('getdata');
	}

	public function index_get()
	{
		//get_class_methods($this->get_data('info_penyakit'));
		$data['gejala'] = $this->getdata->_resultDB('info_gejala');
		$data['check']	= $this->getdata->_resultDB('info_gejala','num_rows');

		$this->response($data, RestController::HTTP_CREATED); 
        
		
	}

	public function Hasil_post()
	{
		isset($_POST['pilihan']) ? '' : exit('No direct script access allowed');
		$arr = array(
			'table'			=> 'aturan',
			'where_in'	=> array(
				'key'		=> 'gejala_id',
				'data'	=> json_decode($_POST['pilihan'],true)
			),
		);

		$olah = $this->getdata->_resultDB($arr);
		$dd	 = $this->result_MYCIN($olah);
		$data['result'] = [];
		// print_r($_POST['pilihan']);
		foreach ($dd as ['info' => $info, 'hasil' => $hasil]):
			$gejala = "";
			$gejaladipilih="";
			foreach ($info as ['gejala_id' => $gejalaId, 'gejala_kode'=> $gejalaKode, 'gejala_nama' => $gejalaNama]):
				if(in_array($gejalaId, json_decode($_POST['pilihan']))){
					$gejala .= "".$gejalaNama.",";
					$gejaladipilih .= "".$gejalaNama.",";
				}else{
					$gejala .= $gejalaNama.",";
				}
			endforeach;
			$array = ['id' => '1', 'penyakit' => end($info)['penyakit_nama'], 'jenis' => end($info)['penyakit_jenis'], 'probabilitas' => str_replace(".",',',$hasil)."%", 'solusi' => end($info)['penyakit_solusi'], 'gejala' => $gejaladipilih, 'semuagejala' => $gejala];
			if ($hasil>0) {
				$data['result'][] = $array;
			}
			
		endforeach;
		
		$data['pilihan'] = $_POST['pilihan'];

		$this->response($data, RestController::HTTP_CREATED);
	}

	/**
	*	Perhitungan MYCIN
	*/


	private function sortirProb( $items = array() )
	{
		if (!function_exists('sortByProb'))
		{
			function sortByProb( $a, $b )
			{
				return $a['hasil'] == $b['hasil'] ? 0 : ( $b['hasil'] < $a['hasil'] ? -1 : 1 );
			}
		}
		usort($items, 'sortByProb');

		return $items;
	}

	/* Penyelarasan data untuk ditampilkan */
	private function result_MYCIN( $items )
	{
        $data=[];
		// return $items;
		switch ( is_array($items) )
		{
			case TRUE:
			 $count = count($items);
			 break;

			default:
			 return exit('Terjadi kesalahan pada saat pemasukan data! Tidak dapat melanjutkan perhitungan. Harap masukkan data array.');
			 break;
		}

		foreach ($items as $val)
		{
			if ( array_key_exists('cf', $val) &  array_key_exists('id', $val) & array_key_exists('gejala_id', $val) & array_key_exists('penyakit_id', $val) )
			{
				list( 'penyakit_id' => $penyakit,'gejala_id' => $gejala_id, 'cf' => $cf, 'id' => $id ) = $val;

				$no	 = isset($no) & isset($prev) ? ( $penyakit === $prev ? $no + 1 : 0 ) : 0;
				$prev = isset($prev) ? ( $penyakit === $prev ? $prev : $penyakit ) : $penyakit;

				$data[$penyakit][$no]['cf'] = $cf;
				$data[$penyakit][$no]['gejala_id'] = $gejala_id;

				$gejala[$penyakit][$no] = $id;

				unset($penyakit, $gejala_id, $cf, $id);
			}
			else return exit('Terjadi kesalahan! Terdapat data yang tidak ditemukan. Harap periksa kembali data yang di masukkan untuk perhitungan.');
		}
		unset($val, $no, $prev);

		switch ( $count >= 0 )
		{
		 case TRUE:
		 	 $select = array(
				 'info_gejala.id as gejala_id',
				 'info_gejala.kode as gejala_kode',
				 'info_gejala.nama_gjl as gejala_nama',
				 'info_penyakit.kode as penyakit_kode',
				 'info_penyakit.nama_pkt as penyakit_nama',
				 'info_penyakit.solusi as penyakit_solusi',
				 'info_penyakit.jenis as penyakit_jenis'
			 );

			 foreach ( $data as $penyakit => $val )
			 {
				 $prob = $this->count($val);

				// if ( $prob != FALSE)
				 //{
					 $no	 = isset($no) ? $no+1 : 0 ;

					 $output[$no]['penyakit']	= $penyakit;
					 $output[$no]['hasil'] 		= $prob;

					 $arr = array(
						 'table'			=> 'aturan',
						 'select'		=> implode(',',$select),
						 'where_in'	=> array(
							 'key'		=> 'aturan.penyakit_id',
							 'data'	=> $penyakit,
						 ),
						 'join' 		=> array(
							 array(
								 'table' 	=> 'info_penyakit',
								 'on'			=> 'info_penyakit.id = aturan.penyakit_id',
							 ),
							 array(
								 'table' => 'info_gejala',
								 'on'		=> 'info_gejala.id = aturan.gejala_id',
							 ),
						 ),
					 );
					 $output[$no]['info'] = $this->getdata->_resultDB($arr);
				// }
			 }
			 return isset($output) ? $this->sortirProb( $output ) : FALSE;
			 break;

		 default:
			 return FALSE;
			 break;
		}
	}

	/* Untuk mencari hasil perhitungan */
	private function count($data)
	{
		$key = array_keys($data);

		list($first) = $key;
		$last	= end($key);

		// if ( $last == 0 ) $output = FALSE;
		// else
		// {
			$cf12=0;
			$cfuser=json_decode($_POST['cfuser'],true);
			$listcfuser = [];
			foreach ($cfuser as $cu){
				$split = explode('789',(string)$cu);
				$listcfuser[$split[0]]=$split[1];
			}
			
			foreach ($data as $no => [ 'cf' => $cf, 'gejala_id' => $gejala_id ])
			{
				$cfuserawal= $listcfuser[(string)$gejala_id]; //ini nilainya 1,2,3,4,5,6
				// $tesss = array('1'=>'0', '2'=>'0.2', '3'=>'0.4','4'=>'0,6', '5'=>'0.8','6'=>'1');
				$tesss = [0,0.2,0.4,0.6,0.8,1];
				$cfuserakhir=$tesss[((int)$cfuserawal-1)];
				$cf=$cf*$cfuserakhir;
				if($first === $no){
					$cf12 = $cf;
				} 
				else{
				$cf12 = $cf12 + (($cf)* (1-$cf12));
				}
				// $mb_lama = $first === $no ? $mb : ( $mb_lama + ( $mb * ( 1 - $mb_lama) ) );
				// $md_lama = $first === $no ? $md : ( $md_lama + ( $md * ( 1 - $md_lama) ) );

				// $output 	= $last === $no ? ( $mb_lama - $md_lama  ) : FALSE;
			}
			$output = $cf12;
		//}

		return $output === FALSE ? FALSE : round( $output * 100 , 2, PHP_ROUND_HALF_UP );
	}
}
