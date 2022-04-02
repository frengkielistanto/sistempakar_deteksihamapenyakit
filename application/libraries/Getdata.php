<?php
class Getdata extends CI_Controller
{
  private $CI;
  public function __construct()
  {
    $CI =& get_instance();
  }

  /**
	 * Mendapatkan data dari database
	 *
	 * Mendapatkan informasi dari database
	 *
	 * @param array untuk pengambilan opsi atau gunakan @param string
	 *	- Gunakan array dengan keyword 'table' untuk menunjukan tabel yang di tuju,
	 *	- Gunakan array dengan key 'select' untuk mendefiniskan
	 *
	 */

	 public function _resultDB( $items = array() , $result ='' )
	 {
     $CI =& get_instance();
		 $attributes = is_array($items) ? $items : array($items);
	   $_show     = !is_array($result) ? $result : 'fetch_all';

	   $query = $this->_getQuery($attributes);
	   switch ( $_show )
	   {
			 case 'num_rows':
			 	 return $query->num_rows();
			 	 break;

       case 'row_array':
         return $query->row_array();
         break;

	     default:
	       return $query->result_array();
	       break;
	   }

	 }

   public function _getData()
   {
     $select = array(
       'aturan.cf',
       'info_gejala.id as gejala_id',
       'info_gejala.kode as gejala_kode',
       'info_gejala.nama_gjl as gejala_nama',
       'info_penyakit.id as penyakit_id',
       'info_penyakit.kode as penyakit_kode',
       'info_penyakit.nama_pkt as penyakit_nama',
       'info_penyakit.solusi as penyakit_solusi',
       'info_penyakit.jenis as penyakit_jenis'
     );
    
     $arr = array(
       'table'			=> 'aturan',
       'select'		=> implode(',',$select),
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
     $output['check'] = $this->_resultDB($arr,'num_rows');
     $output['check'] != 0 ? $output['info'] = $this->sortirPenyakit( $this->_resultDB($arr) ): FALSE;
     return $output;
   }

   /**
   *  untuk melakukan register ke dalam database
   *  @param array
   *
   */

	 private function _getQuery( $attributes )
	 {
     $CI =& get_instance();

		 if ( func_num_args() == 0 ) return exit('Terjadi kesalahan dalam mendefinisikan data!');

		 /* SETTING DEFAULT DATA UNTUK PROSES */
	   $table 	= array_key_exists('table',$attributes) ? $attributes['table'] : $attributes[0];
	   $select	= array_key_exists('select',$attributes) ? $attributes['select'] : '*';

		 if ( array_key_exists('where_in',$attributes) )
		 {
			 $key = array_key_exists('key',$attributes['where_in']) ? $attributes['where_in']['key'] : FALSE;
			 $val = array_key_exists('data',$attributes['where_in']) ? $attributes['where_in']['data'] : FALSE;


			 switch ( $key===FALSE & $val===FALSE )
			 {
         case TRUE:
            return exit('Terjadi kesalahan pada penggunaan fungsi where_in! Gunakan data dengan kunci array "key" pada kolom yang di seleksi dan "data" pada data yang akan di cari.');
            break;
         default:
            $CI->db->where_in($key, $val);
            break;
       }

			 unset($key, $val, $check_key, $check_val);
		 }

     if ( array_key_exists('like',$attributes) )
		 {
			 $key = array_key_exists('key',$attributes['like']) ? $attributes['like']['key'] : FALSE;
			 $val = array_key_exists('data',$attributes['like']) ? $attributes['like']['data'] : FALSE;


			 switch ( $key===FALSE & $val===FALSE )
			 {
         case TRUE:
            return exit('Terjadi kesalahan pada penggunaan fungsi like! Gunakan data dengan kunci array "key" pada kolom yang di seleksi dan "data" pada data yang akan di cari.');
            break;
         default:
            $CI->db->like($key, $val);
            break;
       }

			 unset($key, $val, $check_key, $check_val);
		 }

     if ( array_key_exists('like_array',$attributes) )
     {
       switch ( !is_array($attributes['like_array']) ) {
         case TRUE:
           return exit('Tidak dapat melanjutkan perintah. Gunakan array untuk menggunakan fungsi ini!');
           break;

         default:
           foreach ($attributes['like_array'] as $key => $val)
           {
             $CI->db->like($key,$val);
           }
           unset($key, $val);
           break;
       }
     }

		 if ( array_key_exists('join',$attributes) )
		 {
			 switch (is_array($attributes['join']))
			 {
				 case TRUE:
				 	foreach ($attributes['join'] as $num => $value)
					{
						$key = array_key_exists('table',$value) ? $value['table'] : FALSE;
						$val = array_key_exists('on',$value) ? $value['on'] : FALSE;
						switch ( $key===FALSE & $val===FALSE )
						{
							case TRUE:
								return exit('Terjadi kesalahan pada penggunaan fungsi join! Gunakan data dengan kunci array "table" pada tabel yang akan di gabungkan dan "on" pada data penghubung antara tabel primary keys dan tabel foreign keys.');
								break;

							default:
								$CI->db->join($key, $val);
								break;
						}

						unset($key, $val);
				 	}
					unset($num, $value);
				 	break;

				 default:
				 	$key = array_key_exists('table',$attributes['join']) ? $attributes['join']['table'] : FALSE;
					$val = array_key_exists('on',$attributes['join']) ? $attributes['join']['on'] : FALSE;

					switch ( $key===FALSE & $val===FALSE )
					{
						case TRUE:
						 return exit('Terjadi kesalahan pada penggunaan fungsi join! Gunakan data dengan kunci array "table" pada tabel yang akan di gabungkan dan "on" pada data penghubung antara tabel primary keys dan tabel foreign keys.');
						 break;
						default:
						 $CI->db->join($key, $val);
						 break;
					 }

				 unset($key, $val);
			 }
		 }

     if ( array_key_exists('limit',$attributes) )
     {
       switch ( is_array($attributes['limit']) ) {
         case TRUE:
           return exit('Tidak dapat memasukkan data array.');
           break;

         default:
           $CI->db->limit($attributes['limit']);
           break;
       }
     }

	   $CI->db->select($select);
	   $CI->db->from($table);
	   return $CI->db->get();
	 }

   private function sortirPenyakit( $items = array() )
   {
     if (!function_exists('sortByProb'))
     {
       function sortByProb( $a, $b )
       {
         return $a['penyakit_kode'] == $b['penyakit_kode'] ? 0 : ( $b['penyakit_kode'] != $a['penyakit_kode'] ? -1 : 1 );
       }
     }

     usort($items, 'sortByProb');
     unset($a,$b);

     list($first) = array_keys($items);

     foreach ($items as ['penyakit_id' => $penyakit_id,
 												'penyakit_kode' => $penyakit_kode,
 												'penyakit_nama' => $penyakit_nama,
                        'penyakit_jenis' => $penyakit_jenis,
 												'penyakit_solusi' => $penyakit_sol,
 												'gejala_id' => $gejala_id,
 												'gejala_kode'	=> $gejala_kode,
 												'gejala_nama'	=> $gejala_nama,
 												'cf' => $cf])
       {
         $no						= isset($oldPenyakit) ? ( $oldPenyakit==$penyakit_id ? $no+1 : 0 ) : 0;
         $oldPenyakit	= isset($oldPenyakit) ? ( $oldPenyakit==$penyakit_id ? $oldPenyakit : $penyakit_id ) : $penyakit_id;
         $num					= $penyakit_id;

         if ($no==0)
         {
           $data[$num]['penyakit_id'] 				= $penyakit_id;
           $data[$num]['penyakit_kode']				= $penyakit_kode;
           $data[$num]['penyakit_nama']  			= $penyakit_nama;
           $data[$num]['penyakit_jenis']  		= $penyakit_jenis;
           $data[$num]['penyakit_solusi']	    = $penyakit_sol;
         }

         $data[$num]['gejala_id'][$no]							= $gejala_id;
         $data[$num]['gejala_kode'][$no]						= $gejala_kode;
         $data[$num]['gejala_nama'][$no]						= $gejala_nama;

      
         $data[$num]['cf'][$no]											= $cf;
       }
       unset($no, $oldPenyakit, $num, $cf, $gejala_nama, $gejala_kode, $gejala_id, $penyakit_sol, $penyakit_nama, $penyakit_jenis, $penyakit_kode, $penyakit_id);

       return $data;
     }
   }

?>
