<?php 
/**
 * Barang_keluar Page Controller
 * @category  Controller
 */
class Barang_keluarController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "barang_keluar";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("id_nomor_keluar", 
			"nama", 
			"kode_bidang", 
			"tanggal_keluar", 
			"nama_barang", 
			"satuan", 
			"jumlah_unit_keluar");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				barang_keluar.id_nomor_keluar LIKE ? OR 
				barang_keluar.nama LIKE ? OR 
				barang_keluar.kode_bidang LIKE ? OR 
				barang_keluar.tanggal_keluar LIKE ? OR 
				barang_keluar.nama_barang LIKE ? OR 
				barang_keluar.satuan LIKE ? OR 
				barang_keluar.jumlah_unit_keluar LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "barang_keluar/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("barang_keluar.id_nomor_keluar", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Barang Keluar";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("barang_keluar/list.php", $data); //render the full page
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("nama","kode_bidang","tanggal_keluar","nama_barang","satuan","jumlah_unit_keluar");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'nama' => 'required',
				'kode_bidang' => 'required',
				'tanggal_keluar' => 'required',
				'nama_barang' => 'required',
				'satuan' => 'required',
				'jumlah_unit_keluar' => 'required',
			);
			$this->sanitize_array = array(
				'nama' => 'sanitize_string',
				'kode_bidang' => 'sanitize_string',
				'tanggal_keluar' => 'sanitize_string',
				'nama_barang' => 'sanitize_string',
				'satuan' => 'sanitize_string',
				'jumlah_unit_keluar' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("barang_keluar");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Barang Keluar";
		$this->render_view("barang_keluar/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id_nomor_keluar","nama","kode_bidang","tanggal_keluar","nama_barang","satuan","jumlah_unit_keluar");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'nama' => 'required',
				'kode_bidang' => 'required',
				'tanggal_keluar' => 'required',
				'nama_barang' => 'required',
				'satuan' => 'required',
				'jumlah_unit_keluar' => 'required',
			);
			$this->sanitize_array = array(
				'nama' => 'sanitize_string',
				'kode_bidang' => 'sanitize_string',
				'tanggal_keluar' => 'sanitize_string',
				'nama_barang' => 'sanitize_string',
				'satuan' => 'sanitize_string',
				'jumlah_unit_keluar' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("barang_keluar.id_nomor_keluar", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("barang_keluar");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("barang_keluar");
					}
				}
			}
		}
		$db->where("barang_keluar.id_nomor_keluar", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Barang Keluar";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("barang_keluar/edit.php", $data);
	}
	/**
     * Update single field
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editfield($rec_id = null, $formdata = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("id_nomor_keluar","nama","kode_bidang","tanggal_keluar","nama_barang","satuan","jumlah_unit_keluar");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'nama' => 'required',
				'kode_bidang' => 'required',
				'tanggal_keluar' => 'required',
				'nama_barang' => 'required',
				'satuan' => 'required',
				'jumlah_unit_keluar' => 'required',
			);
			$this->sanitize_array = array(
				'nama' => 'sanitize_string',
				'kode_bidang' => 'sanitize_string',
				'tanggal_keluar' => 'sanitize_string',
				'nama_barang' => 'sanitize_string',
				'satuan' => 'sanitize_string',
				'jumlah_unit_keluar' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("barang_keluar.id_nomor_keluar", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount();
				if($bool && $numRows){
					return render_json(
						array(
							'num_rows' =>$numRows,
							'rec_id' =>$rec_id,
						)
					);
				}
				else{
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = "No record updated";
					}
					render_error($page_error);
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		return null;
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("barang_keluar.id_nomor_keluar", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("barang_keluar");
	}
}
