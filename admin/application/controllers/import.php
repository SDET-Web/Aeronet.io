<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class import extends CI_Controller
{
	public function airport()
	{
		is_logged_in();
		$this->load->view('head', array('controller' => 'airport'));
		$this->load->view('airport/import');
		$this->load->view('foot');
	}

	public function airport_ajax()
	{
		is_logged_in();
		$this->load->library('excel');
		$inputFileName = '/var/www/html/aircraft/skin/upload/tmpXLS/' . $_POST['xelFile'];
		$this->excel->load($inputFileName);
		$sheetData = $this->excel->getActiveSheet()->toArray(null, true, true, true);
		foreach ($sheetData as $airport) {
			if ($airport['E'] != 'City') {
				$data['CITY'] = trim($airport['E']);
				$data['STATE'] = trim($airport['B']);
				$data['COUNTY'] = trim($airport['F']);
				$data['AIRPORT'] = trim($airport['G']);
				$data['LETTER_3'] = trim($airport['J']);
				$data['AIRPORT_CONTACT'] = trim($airport['R']);
				$data['USE'] = (trim($airport['I']) == 'PR' ? 1 : 2);
				$recCount = $this->db->from('airports')->where('CITY', trim($airport['E']))->where('STATE', trim($airport['B']))->where('COUNTY', trim($airport['F']))->where('LETTER_3', trim($airport['J']))->get()->num_rows();
				if ($recCount == 0) {
					$this->db->insert('airports', $data);
				} else {
					$this->db->where('CITY', trim($airport['E']))->where('STATE', trim($airport['B']))->where('COUNTY', trim($airport['F']))->where('LETTER_3', trim($airport['J']));
					$this->db->insert('update', $data);
				}
			}
		}
	}

	public function aircraft()
	{
		is_logged_in();
		$this->load->view('head', array('controller' => 'aircraft'));
		$this->load->view('aircraft/import');
		$this->load->view('foot');
	}

	public function aircraft_ajax()
	{
		is_logged_in();
		$this->load->library('excel');
		$inputFileName = '/var/www/html/aircraft/skin/upload/tmpXLS/' . $_POST['xelFile'];
		$this->excel->load($inputFileName);
		$sheetData = $this->excel->getActiveSheet()->toArray(null, true, true, true);
		$county = '';
		foreach ($sheetData as $aircraft) {
			if ($aircraft['B'] != '' && $aircraft['B'] != 'serial_number') {
				$data['n_number'] = trim($aircraft['A']);
				$data['serial_number'] = trim($aircraft['B']);
				$data['name'] = trim($aircraft['C']);
				$data['street'] = trim($aircraft['D']);
				$data['city'] = trim($aircraft['E']);
				$data['state'] = trim($aircraft['F']);
				$data['county'] = $county;
				$data['zip_code'] = trim($aircraft['G']);
				$data['mfr_name'] = trim($aircraft['H']);
				$data['year_mfr'] = trim($aircraft['I']);
				$data['model_name'] = trim($aircraft['J']);
				$data['cert_issue_date'] = trim($aircraft['K']);
				$data['ac_weight'] = trim($aircraft['L']);
				$data['type_registrant'] = trim($aircraft['M']);
				$data['aircart_type'] = 1;
				$recCount = $this->db->from('aircrafts')->where('n_number', trim($aircraft['A']))->get()->num_rows();
				if ($recCount == 0) {
					$this->db->insert('aircrafts', $data);
				} else {
					$this->db->where('n_number', trim($aircraft['A']));
					$this->db->update('aircrafts', $data);
				}


				$data_county['county'] = $county;
				$data_county['state'] = trim($aircraft['F']);
				if ($this->db->from('counties')->where('county', $county)->where('state', trim($aircraft['F']))->get()->num_rows() == 0) {
					$this->db->insert('counties', $data_county);
				}
			} else if (strpos($aircraft['A'], 'County Entered:') !== FALSE) {
				$county = str_replace('County Entered:', '', trim($aircraft['A']));
			}
		}

	}

	public function exterior()
	{
		is_logged_in();
		$this->load->view('head', array('controller' => 'exterior'));
		$this->load->view('exterior/import');
		$this->load->view('foot');
	}

	public function exterior_ajax()
	{
		is_logged_in();
		$this->load->library('excel');
		$inputFileName = '/var/www/html/aircraft/skin/upload/tmpXLS/' . $_POST['xelFile'];
		$this->excel->load($inputFileName);
		$sheetData = $this->excel->getActiveSheet()->toArray(null, true, true, true);
		$county = '';
		//print_r($sheetData);
		$show = false;
		$tmp = '';
		foreach ($sheetData as $exterior) {
			if ($show == true) {
				if ($exterior['A'] != $tmp && trim($exterior['A']) != '') {
					$tmp = trim($exterior['A']);
				}
				$exterior['A'] = $tmp;
				//Wet Wash
				if (trim($exterior['B']) != '') {
					$this->insert_exterior(trim($exterior['A']), trim($exterior['B']), 'Wet Wash', '', '', str_replace('$', '', trim($exterior['C'])));
					$this->insert_exterior(trim($exterior['A']), trim($exterior['B']), 'Dry Wash', '', '', str_replace('$', '', trim($exterior['D'])));
					$this->insert_exterior(trim($exterior['A']), trim($exterior['B']), 'Exterior Paint', str_replace('$', '', trim($exterior['E'])), str_replace('$', '', trim($exterior['F'])), '');
					$this->insert_exterior(trim($exterior['A']), trim($exterior['B']), 'Bright Work', str_replace('$', '', trim($exterior['G'])), str_replace('$', '', trim($exterior['H'])), '');
					$this->insert_exterior(trim($exterior['A']), trim($exterior['B']), 'De-Ice Boots', str_replace('$', '', trim($exterior['I'])), str_replace('$', '', trim($exterior['J'])), '');
					$this->insert_exterior(trim($exterior['A']), trim($exterior['B']), 'Landing Gear', '', '', str_replace('$', '', trim($exterior['K'])));
				}
			}
			if ($exterior['E'] == 'Rejuvination') {
				$show = true;
			}
		}

	}

	private function insert_exterior($make_txt, $model_txt, $title, $rej, $upk, $oth, $fbu = 0, $fbp = 0, $obu = 0, $air = 0, $pio = 0, $table = 'exterior')
	{
		if ($rej == 'N/A') {
			$rej = '';
		}
		if ($upk == 'N/A') {
			$upk = '';
		}
		if ($oth == 'N/A') {
			$oth = '';
		}

		$make = $this->db->from('manufacturer')->where('manufacturer', $make_txt)->get();
		$make_id = 0;
		if ($make->num_rows() > 0) {
			$make_id = $make->row()->maker_id;
		} else {
			$data_maker['manufacturer'] = $make_txt;
			$this->db->insert('manufacturer', $data_maker);
			$make_id = $this->db->insert_id();
		}

		$model = $this->db->from('models')->where('maker_id', $make_id)->where('model', $model_txt)->get();
		$model_id = 0;
		if ($model->num_rows() > 0) {
			$model_id = $model->row()->model_id;
		} else {
			$data_model['model'] = $model_txt;
			$data_model['maker_id'] = $make_id;
			$this->db->insert('models', $data_model);
			$model_id = $this->db->insert_id();
		}
		$data['model_id'] = $model_id;
		$data['title'] = $title;
		$data['rejuvination_price'] = $rej;
		$data['upkeep_price'] = $upk;
		$data['other_price'] = $oth;
		if ($fbu != 0) {
			$data_model['fuel_burn'] = $fbu;
			$data_model['fuel_price'] = $fbp;
			$data_model['oil_burn'] = $obu;
			$data_model['airport_expense'] = $air;
			$data_model['piolet_count'] = $pio;
			$this->db->where('model_id', $model_id);
			$this->db->update('models', $data_model);
		}


		$data['created'] = date('Y-m-d h:i:s');
		$data['createdby'] = 1;
		$data['modified'] = date('Y-m-d h:i:s');
		$data['modifiedby'] = 1;
		$ex_id = 0;
		$ex_data = $this->db->from($table)->where('model_id', $model_id)->where('title', $title)->get();

		if ($rej != '' || $upk != '' || $oth != '') {
			if ($ex_data->num_rows() > 0) {
				$this->db->where('id', $ex_data->row()->id);
				$this->db->update($table, $data);
			} else {
				$this->db->insert($table, $data);
			}
		}
	}

	public function interior()
	{
		is_logged_in();
		$this->load->view('head', array('controller' => 'interior'));
		$this->load->view('interior/import');
		$this->load->view('foot');
	}

	public function interior_ajax()
	{
		is_logged_in();
		$this->load->library('excel');
		$inputFileName = RIZ_ABSOLUTE . '/skin/upload/' . $_POST['xelFile'];
		$this->excel->load($inputFileName);
		$sheetData = $this->excel->getActiveSheet()->toArray(null, true, true, true);
		$county = '';
		//print_r($sheetData);
		$show = false;
		$tmp = '';
		foreach ($sheetData as $exterior) {
			if ($show == true) {
				if ($exterior['A'] != $tmp && trim($exterior['A']) != '') {
					$tmp = trim($exterior['A']);
				}
				$exterior['A'] = $tmp;
				//Wet Wash
				if (trim($exterior['B']) != '') {
					$this->insert_exterior(trim($exterior['A']), trim($exterior['B']), 'Carpet', str_replace('$', '', trim($exterior['C'])), str_replace('$', '', trim($exterior['D'])), '', str_replace('$', '', trim($exterior['J'])), str_replace('$', '', trim($exterior['K'])), str_replace('$', '', trim($exterior['L'])), str_replace('$', '', trim($exterior['M'])), str_replace('$', '', trim($exterior['N'])), 'interior');
					$this->insert_exterior(trim($exterior['A']), trim($exterior['B']), 'Leather', str_replace('$', '', trim($exterior['E'])), str_replace('$', '', trim($exterior['F'])), str_replace('$', '', trim($exterior['G'])), str_replace('$', '', trim($exterior['J'])), str_replace('$', '', trim($exterior['K'])), str_replace('$', '', trim($exterior['L'])), str_replace('$', '', trim($exterior['M'])), str_replace('$', '', trim($exterior['N'])), 'interior');
					$this->insert_exterior(trim($exterior['A']), trim($exterior['B']), 'Cabinetry', '', '', str_replace('$', '', trim($exterior['H'])), str_replace('$', '', trim($exterior['J'])), str_replace('$', '', trim($exterior['K'])), str_replace('$', '', trim($exterior['L'])), str_replace('$', '', trim($exterior['M'])), str_replace('$', '', trim($exterior['N'])), 'interior');
					$this->insert_exterior(trim($exterior['A']), trim($exterior['B']), 'Glass', '', '', str_replace('$', '', trim($exterior['I'])), str_replace('$', '', trim($exterior['J'])), str_replace('$', '', trim($exterior['K'])), str_replace('$', '', trim($exterior['L'])), str_replace('$', '', trim($exterior['M'])), str_replace('$', '', trim($exterior['N'])), 'interior');
				}
			}
			if ($exterior['C'] == 'Rejuvination') {
				$show = true;
			}
		}

	}

	public function insert_pilot($unique_id, $fname, $lname, $street1, $street2, $city, $state, $zip, $country, $region, $med_class, $med_date, $med_exp_date, $type)
	{
		if ($unique_id != '' && $unique_id != 'UNIQUE ID') {
			$data['unique_id'] = $unique_id;
			$data['first_name'] = $fname;
			$data['last_name'] = $lname;
			$data['street1'] = $street1;
			$data['street2'] = $street2;
			$data['city'] = $city;
			$data['state'] = $state;
			$data['zip'] = $zip;
			$data['country'] = $country;
			$data['region'] = $region;
			$data['med_class'] = ($med_class == '' ? 0 : $med_class);
			$data['med_date'] = $med_date;
			$data['med_exp_date'] = $med_exp_date;
			$data['type'] = $this->input->get_post('type', 'n') ? 1 : 0;
			$this->db->insert('directory_pilot', $data);
			//print_r($data);
			//echo $this->db->_error_message();exit;
		}
	}


	public function pilot()
	{
		is_logged_in();
		$this->load->view('head', array('controller' => 'pilot'));
		$this->load->view('pilot/import');
		$this->load->view('foot');
	}

	public function pilot_ajax()
	{
		if (strpos($this->input->get_post('xelFile'), '_CERT') !== FALSE) {
			if ($this->input->get_post('clean') != '') {
				$this->db->empty_table('directory_pilot_certificate');
			}
			$inputFileName = RIZ_ABSOLUTE . '/skin/upload/' . $this->input->get_post('xelFile');// '/var/www/html/aircraft/skin/upload/tmpXLS/'.$_POST['xelFile'];
			$handle = fopen($inputFileName, "r");
			$row = 0;
			$this->db->db_debug = FALSE;
			while (($pilot = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$row++;

				if (trim($pilot[0]) != 'UNIQUE ID' && trim($pilot[0]) != 'RATING66') {
					$tmp_rating = '';
					for ($i = 6; $i < 17; $i++) {
						if (trim($pilot[$i]) != '') {
							$tmp_rating .= trim($pilot[$i]) . ',';
						}
					}
					$tmp_typerating = '';
					for ($i = 17; $i < count($pilot); $i++) {
						if (trim($pilot[$i]) != '') {
							$tmp_typerating .= trim($pilot[$i]) . ',';
						}
					}
					$this->insert_pilot_certificate(
						trim($pilot[0]),
						trim($pilot[3]),
						trim($pilot[4]),
						trim($pilot[5]),
						substr($tmp_rating, 0, -1),
						substr($tmp_typerating, 0, -1)
					);

				}
			}
			fclose($handle);
		} else {
			$this->db->delete('directory_pilot', array('unique_id !=' => '', 'type' => $this->input->get_post('type')));
			$inputFileName = RIZ_ABSOLUTE . '/skin/upload/' . $this->input->get_post('xelFile');// '/var/www/html/aircraft/skin/upload/tmpXLS/'.$_POST['xelFile'];
			$handle = fopen($inputFileName, "r");
			$row = 0;
			$this->db->db_debug = FALSE;
			while (($pilot = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$row++;
				if (trim($pilot[0]) != 'UNIQUE ID') {
					$mdate_year = substr(trim($pilot[11]), -4);
					$mdate_month = str_replace($mdate_year, '', trim($pilot[11]));
					$mdate = $mdate_month . '/' . $mdate_year;
					if (trim($mdate) == '/' && trim($mdate) == '0') {
						$mdate = '';
					}
					$mdate_year_exp = substr(trim($pilot[12]), -4);
					$mdate_month_exp = str_replace($mdate_year_exp, '', trim($pilot[12]));
					$mdate_exp = $mdate_month_exp . '/' . $mdate_year_exp;
					if (trim($mdate_exp) == '/' && trim($mdate_exp) == '0') {
						$mdate = '';
					}
					$this->insert_pilot(trim($pilot[0]), trim($pilot[1]), trim($pilot[2]), trim($pilot[3]), trim($pilot[4]), trim($pilot[5]), trim($pilot[6]), trim($pilot[7]), trim($pilot[8]), trim($pilot[9]), trim($pilot[10]), $mdate, $mdate_exp, $this->input->get_post('type'));
				}
			}
			fclose($handle);
		}

	}

	public function insert_pilot_certificate($unique_id, $type, $level, $expire_date, $rating, $type_rating)
	{
		$data['unique_id'] = $unique_id;
		$data['type'] = $type;
		$data['level'] = $level;
		//$data['expire_date'] = $expire_date;
		$data['rating'] = $rating;
		$data['type_rating'] = $type_rating;
		$this->db->insert('directory_pilot_certificate', $data);
	}

	public function pilot_certificate()
	{
		is_logged_in();
		$this->load->view('head', array('controller' => 'pilot_certificate'));
		$this->load->view('pilot/import');
		$this->load->view('foot');
	}

	public function pilot_certificate_ajax()
	{
		exit;
		$this->db->delete('directory_pilot_certificate', array('unique_id !=' => ''));
		is_logged_in();
		$inputFileName = RIZ_ABSOLUTE . '/skin/upload/' . $this->input->get_post('xelFile');// '/var/www/html/aircraft/skin/upload/tmpXLS/'.$_POST['xelFile'];
		$handle = fopen($inputFileName, "r");
		$row = 0;
		while (($pilot = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$row++;
			//if($row != 0) {
			$tmp_rating = '';
			for ($i = 6; $i < 17; $i++) {
				if (trim($pilot[$i]) != '') {
					$tmp_rating .= trim($pilot[$i]) . ',';
				}
			}
			$tmp_typerating = '';
			for ($i = 17; $i < count($pilot); $i++) {
				if (trim($pilot[$i]) != '') {
					$tmp_typerating .= trim($pilot[$i]) . ',';
				}
			}
			$this->insert_pilot_certificate(trim($pilot[0]), trim($pilot[3]), trim($pilot[4]), trim($pilot[5]), $tmp_rating, $tmp_typerating);
			//}
		}
		fclose($handle);
	}

	public function directory_deptartment()
	{
		is_logged_in();
		$this->load->view('head', array('controller' => 'department'));
		$this->load->view('department/import');
		$this->load->view('foot');
	}

	public function department_ajax()
	{
		$this->db->delete('directory_deptartment', array('id !=' => ''));
		is_logged_in();
		$inputFileName = RIZ_ABSOLUTE . '/skin/upload/' . $this->input->get_post('xelFile');// '/var/www/html/aircraft/skin/upload/tmpXLS/'.$_POST['xelFile'];
		$handle = fopen($inputFileName, "r");
		$row = 0;
		while (($pilot = fgetcsv($handle, 1000, ",")) !== FALSE) {
			if ($row != 0 && trim($pilot[1]) != '') {
				$this->insert_department(trim($pilot[0]), trim($pilot[1]), ""/*trim($pilot[4])*/, ""/*trim($pilot[5])*/, trim($pilot[3]), trim($pilot[4]), ""/*trim($pilot[6])*/, trim($pilot[2]), ""/*trim($pilot[8])*/);
			}
			$row++;
		}
		fclose($handle);
	}

	private function insert_department($logo, $company, $address, $email, $city, $state, $phone, $planes, $bio)
	{

		$data['company'] = $company;
		$data['logo'] = $logo;
		$data['address'] = $address;
		$data['city'] = $city;
		$data['state'] = $state;
		$data['email'] = $email;
		$data['phone'] = $phone;
		$data['planes'] = $planes;
		$data['bio'] = $bio;
		$this->db->insert('directory_deptartment', $data);

	}

	public function cron_job_courses()
	{
		$html = file_get_contents('https://www.faasafety.gov/gslac/ALC/course_catalog.aspx');
		if ($this->input->post('action') != '') {
			$this->db->truncate('directory_courses');
			$this->db->insert_batch('directory_courses', $_POST['data']);
			exit;
		}
		$head = array('controller' => 'Courses');
		$head['type'] = 'course';
		$this->load->view('main', array_merge($head, array('view' => 'cron/course', 'data' => $html)));
	}

	public function aircraft_type_rating()
	{
		is_logged_in();
		$this->load->library('excel');
		$inputFileName = RIZ_ABSOLUTE . '/skin/upload/' . $this->input->get_post('xelFile');
		$this->excel->load($inputFileName);
		$manufacturers = [];
		$output = [];
		foreach ($this->excel->getAllSheets() as $key => $sheet) {
			$sheetData = $sheet->toArray(null, true, true, true);
			foreach ($sheetData as $row) {
				// if the first column is not empty and is not heading and its not reepated / continued item
				if (
					$row["A"] != "" &&
					trim(preg_replace('/\s+/', ' ', $row["A"])) != "TYPE CERTIFICATE HOLDER" &&
					strpos(trim(preg_replace('/\s+/', ' ', $row["A"])), "(continued)") === FALSE
				) {

					// Remove . , the and /
					$term = trim(preg_replace('/\s+/', ' ', str_replace("/", " ", str_replace(".", "", str_replace(",", "", str_replace("The", "", $row["A"]))))));
					// separate terms
					$terms = explode(" ", $term);
					// creating keywords
					$keywords = $terms[0] . (isset($terms[1]) && strpos($terms[1], "(formerly") === FALSE ? " " . trim($terms[1]) : "");
					// search for keywords in manufacturer name
					$aircrafts = $this->db->from("directory_aircrafts")->like("mfr_name", $keywords)->get();
					// if no aircrafts found
					if ($aircrafts->num_rows() == 0) {
						// search only with first term
						$aircrafts = $this->db->from("directory_aircrafts")->like("mfr_name", $terms[0])->get();
					}

					$aircraft = $aircrafts->row_array();
					$mfr = explode(" ", $aircraft["mfr_name"]);
					$manufacturers = [
						"fullName" => trim(preg_replace('/\s+/', ' ', $row["A"])),
						"keywords" => $keywords,
						"aircraft_count" => $aircrafts->num_rows(),
						"dbName" => (isset($aircraft["mfr_name"]) ? $mfr[0] : "")
					];

				}


				if (isset($manufacturers["dbName"]) && $manufacturers["dbName"] != "") {
					$model = trim(preg_replace('/\s+/', ' ', str_replace("/", " ", str_replace(".", "", str_replace(",", "", str_replace("The", "", $row["B"]))))));
					if (strpos($model, "(See") === FALSE) {
						$output[] = process_aircrafts_typerating($row["B"], term_filter($row["E"]), $manufacturers);
						$output[] = process_aircrafts_typerating($row["C"], term_filter($row["E"]), $manufacturers);
					}
				}

			}

		}
	}

	public function import_new_stuff($file){
		$headers = [];
		$handle = fopen(__DIR__."/../uploaded/aircraft/$file.txt", "r");
		//$this->db->empty_table("dir_".strtolower($file));
		if ($handle) {
			$isFirst = true;
			while (($line = fgets($handle)) !== false) {
				$record = explode(',',$line);
				if($isFirst == true){
					$line = str_replace(" ","_",str_replace(")","",str_replace("(","",str_replace("-","_",strtolower($line)))));
					$headers = explode(',', $line);
					$headers[0] = substr(trim($headers[0]),3);
					array_pop($headers);
					$isFirst = false;
				} else {
					$data = [];
					foreach($headers as $key=>$header){
						$data[trim($header,"_")] = (isset($record[$key]) && trim($record[$key]) != '' ? trim($record[$key]) : NULL);
					}
					$this->db->insert("dir_".strtolower($file),$data);
				}
				// process the line read.
			}

			fclose($handle);
		} else {
			// error opening the file.
		}
	}

	public function import_new_table($file){
		$headers = [];
		$handle = fopen(__DIR__."/../uploaded/aircraft/$file.txt", "r");
		if ($handle) {
			$isFirst = true;
			while (($line = fgets($handle)) !== false) {
				$record = explode(',',$line);
				if($isFirst == true){
					$line = str_replace(" ","_",str_replace(")","",str_replace("(","",str_replace("-","_",strtolower($line)))));
					$headers = explode(',', $line);
					$headers[0] = trim($headers[0]);
					array_pop($headers);
					echo (implode(",",$headers));
					return;
				}
			}
		}
	}
}
