<?php
class Data_model extends CI_Model{

	function __construct(){


		parent::__construct();

		$sGeneratedConfiguraionFile_name = 'generated_freq_accessed_config'; // without the .php exstention

		$this->sConfigFile_FullPath = APPPATH . 'config/' . $sGeneratedConfiguraionFile_name . '.php';

		$this->aItemName_TableName_Map = array();
		$this->aItemName_TableName_Map = array(

			'genders' 			=> 'genders',
			'user_types' 		=> 'user_types',
			'user_statuses' 	=> 'user_statuses',
			'online_statuses' 	=> 'online_statuses',
			'user_salutations' 	=> 'user_salutations',
			'online_via' 		=> 'authenticating_sources',
			'enquiry_purposes' 	=> 'enquiry_purposes',
			'page_statuses' 	=> 'page_statuses',
			'token_statuses' 	=> 'token_statuses',
			'token_purposes' 	=> 'token_purposes',
			'enquiry_purpose_statuses' 	=> 'enquiry_purpose_statuses',
			'profile_picture_sources' 	=> 'profile_picture_sources',

			'category_groups' => 'category_group',
			'category_status' => 'category_statuses',
			'category_group_status' => 'category_group_statuses',
			'image_gallery_item_statuses' => 'image_gallery_item_statuses',
			'category'		=> 'categories'
		);


		// We are trying to load a dynamically generated file.
		// If initially this file doesnt exists, run the generateAllConfigItems();
		if( ! file_exists($this->sConfigFile_FullPath) ) {
			$this->generateAllConfigItems();
		}

		$this->load->config($sGeneratedConfiguraionFile_name);



	}



	/**
	 * creates the generated_freq_accessed_config.php file.
	 * will replace the existing file.
	 * @return [type] [description]
	 */
	function generateAllConfigItems() {

		$sFileContents = '';

		foreach ( $this->aItemName_TableName_Map AS $sConfigItemName => $sTableName ) {

			$aTableData = $this->db->get($sTableName)->result();

			$aFormats = array('id-name', 'id-title');
			foreach( $aFormats AS $sFormat) {

				$aData = $this->getDataInFormat($aTableData, $sFormat);

				$sFileContents .= $this->getStringtoAppend($aData, $sConfigItemName, $sFormat);
			}
		}

		// write to Config File
		$this->writeBackTofile($sFileContents);
	}


	/**
	 *
	 * 	Used for fetching from the database, the small data sets which are
	 * 	stored as id, name, title, description.
	 *
	 * @return [type] [description]
	 */
	function getDataItem($sItemName, $format='id-name') {

		$aReturn = array();


		if( isset($this->aItemName_TableName_Map[$sItemName]) ) {

			// if we have the data in config, then dont access database again
			if( $this->config->item($sItemName . '_' . $format) ) {

				$aReturn = $this->config->item($sItemName . '_' . $format);

			} else {

				// see if the config file exists
				if( file_exists($this->sConfigFile_FullPath) ) {

					// fetch the missing value(s) and append to the file

					$sTableName = $this->aItemName_TableName_Map[$sItemName];
					$aTableData = $this->db->get($sTableName)->result();
// p($this->db->last_query());
// p($aTableData);
					if( $aTableData ) {

						$aReturn = $this->getDataInFormat($aTableData, $format);

						$sContentToAppend = $this->getStringtoAppend($aReturn, $sItemName, $format);

						//append to file
						$this->appendToFile($sContentToAppend);
					}

				} else {

					// generate the whole config file then
					$this->generateAllConfigItems();

					$aReturn = $this->config->item($sItemName . '_' . $format);
				}

			}

		}

	    return $aReturn;
	}



	/**
	 * helper function of getDataItem() .
	 *
	 * @param  [type] $aTableData [description]
	 * @param  [type] $sFormat    [description]
	 * @return [type]             [description]
	 */
	function getDataInFormat($aTableData, $sFormat) {

		$aData = array();
		$aParts = explode('-', $sFormat);

		$sKey 	= $aParts[0];
		$sValue = $aParts[1];


		foreach($aTableData AS $oRow) {

			$aData[$oRow->$sKey] = $oRow->$sValue;
		}
		return $aData;
	}


	/**
	 * The array will be converted to array declaration and returned as string
	 * @param  [type] $aDataInFormat [description]
	 * @return [type]                [description]
	 */
	function getStringtoAppend($aDataInFormat, $sConfigItemName, $sFormat) {

		$bString = "\n\n";
		$bString .= '$config' . "['". $sConfigItemName."_".$sFormat. "'] = ";
		$bString .= var_export($aDataInFormat, true);
		$bString .= ';';

		return $bString;
	}



	/**
	 *
	 * Write to the config file.
	 *
	 * @param  [type] $sFileContents [description]
	 * @return [type]                [description]
	 */
	function writeBackTofile($sFileContents) {

		// wrap the file contents
		$sFileContents = $this->wrapFileContents($sFileContents);

		file_put_contents($this->sConfigFile_FullPath, $sFileContents);
	}

	/**
	 * Append to the existing config file
	 * @param  [type] $sFileContents [description]
	 * @return [type]                [description]
	 */
	function appendToFile($sFileContents) {

		// open for appending
		$file_handle = fopen($this->sConfigFile_FullPath, 'a');

		// append to file
		fwrite($file_handle, $sFileContents);

		// close the file
		fclose($file_handle);
	}


	/**
	 *
	 * Wrap the generated config file contents .
	 * with php tags etc.
	 * @param  [type] $sFileContents [description]
	 * @return [type]                [description]
	 */
	function wrapFileContents($sFileContents) {
		$sString = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');";
		$sString .= "\n\n";
		$sString .= "
		/**
		 *
		 *
		 * =============== IMPORTANT ===============
		 *
		 *          This FILE IS GENERATED VIA CODE...
		 *          Do not edit directly!! Refer to Data_model.
		 *
		 * =============== IMPORTANT ===============
		 *
		 */
		";
		$sString .= "\n\n";
		$sString .= $sFileContents;

		/*$sString .= '?>';*/ 	// IMPORTANT : we are not added the closing php tag /
								// This way, we can append to the config file later on

		return $sString;
	}
}
