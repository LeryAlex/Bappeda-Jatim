<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * barang_keluar_kode_bidang_option_list Model Action
     * @return array
     */
	function barang_keluar_kode_bidang_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT nama_bidang AS value,nama_bidang AS label FROM kode_bidang";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * barang_keluar_satuan_option_list Model Action
     * @return array
     */
	function barang_keluar_satuan_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT nama_satuan AS value,nama_satuan AS label FROM satuan";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * barang_masuk_kode_bidang_option_list Model Action
     * @return array
     */
	function barang_masuk_kode_bidang_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT nama_bidang AS value,nama_bidang AS label FROM kode_bidang";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * barang_masuk_satuan_option_list Model Action
     * @return array
     */
	function barang_masuk_satuan_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT nama_satuan AS value,nama_satuan AS label FROM satuan";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * pengguna_username_value_exist Model Action
     * @return array
     */
	function pengguna_username_value_exist($val){
		$db = $this->GetModel();
		$db->where("username", $val);
		$exist = $db->has("pengguna");
		return $exist;
	}

	/**
     * pengguna_email_value_exist Model Action
     * @return array
     */
	function pengguna_email_value_exist($val){
		$db = $this->GetModel();
		$db->where("email", $val);
		$exist = $db->has("pengguna");
		return $exist;
	}

	/**
     * pengguna_user_role_id_option_list Model Action
     * @return array
     */
	function pengguna_user_role_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT role_id AS value, role_name AS label FROM roles";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * getcount_barangmasuk Model Action
     * @return Value
     */
	function getcount_barangmasuk(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM barang_masuk";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_barangkeluar Model Action
     * @return Value
     */
	function getcount_barangkeluar(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM barang_keluar";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_satuan Model Action
     * @return Value
     */
	function getcount_satuan(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM satuan";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_kodebidang Model Action
     * @return Value
     */
	function getcount_kodebidang(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM kode_bidang";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

}
