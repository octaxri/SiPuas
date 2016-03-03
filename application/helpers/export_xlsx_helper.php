<?php
function do_export_xlsx($listRespon) {
	$CI =& get_instance();
	
	// load the excel library
	$CI->load->library('excel');
	
	define('IDX_COL_HOME', 2);	// Kolom dimulai pada kolom ke 3 (index 2)
	define('IDX_ROW_START', 1); // Dimulai dari baris 1
	define('TABLE_COLS', 19);	// Tabel ada 8 kolom
	
	$jmlHasil = count($listRespon);
	
	$exportFileName = "Data Responden Kuisioner.xlsx";
	$columnWidths = array(
			2,	// [A] Padding
			2,	// [B] Padding
			18,	// [C] Kolom Nomer
			8,	// [D] Kolom usia
			14,	// [E] Kolom jenis kelamin
			12,	// [F] Kolom pendidikan
			20, // [G] Kolom pekerjaan
			12,	// [H] Kolom kuisioner 1
			12,	// [J] Kolom kuisioner 3
			12,	// [I] Kolom kuisioner 2
			12, // [K] Kolom kuisioner 4
			12, // [K] Kolom kuisioner 5
			12, // [K] Kolom kuisioner 6
			12, // [K] Kolom kuisioner 7
			12, // [K] Kolom kuisioner 8
			12, // [K] Kolom kuisioner 9
			12, // [K] Kolom kuisioner 10
			12, // [K] Kolom kuisioner 11
			12, // [K] Kolom kuisioner 12
			12, // [K] Kolom kuisioner 13
			12, // [K] Kolom kuisioner 14
			
	);
	$styleHeader = array(
			'alignment' => array(
					'horizontal'	=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical'		=> PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'font'  => array(
					'bold'  => true
			)
	);
	$styleGrayBg = array(
			'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => 'EEEEEE')
			)
	);
	$styleBorderAll = array(
			'borders' => array(
					'allborders'	=> array(
							'style'		=> PHPExcel_Style_Border::BORDER_THIN
					)
			)
	);
	$styleAlignCenterTop = array(
			'alignment' => array(
					'horizontal'	=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical'		=> PHPExcel_Style_Alignment::VERTICAL_TOP,
					'wrap'			=> true
			),
	);
	$styleAPDown = array(
			'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => 'F9BBBC')
			)
	);
	
	// Generate excel....
	try {
		$objPHPExcel = new PHPExcel();
		$worksheetReport = $objPHPExcel->getActiveSheet();
		$worksheetReport->setTitle('Data Hasil Responden');
		
		// Set default alignment ke kiri atas...
		$objPHPExcel->getDefaultStyle()
			->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)
			->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		
		// Set up kolom -----------------------------------
		foreach ($columnWidths as $colIdx => $colWidth) {
			$worksheetReport->getColumnDimensionByColumn($colIdx)->setWidth($colWidth);
		}
		
		// Judul worksheet pada bagian atas
		$worksheetReport->mergeCellsByColumnAndRow(
				IDX_COL_HOME, IDX_ROW_START,
				IDX_COL_HOME+TABLE_COLS-1, IDX_ROW_START+1)
				->setCellValueByColumnAndRow(IDX_COL_HOME, IDX_ROW_START, "Data Hasil Responden Kuisioner Kepuasan Masyarakat");
		
		$worksheetReport->getStyleByColumnAndRow(IDX_COL_HOME, IDX_ROW_START)
			->applyFromArray($styleHeader); // Set style
		$worksheetReport->getStyleByColumnAndRow(IDX_COL_HOME, IDX_ROW_START)
			->getFont()->setSize(18);
		
		$rowBaseTable	= IDX_ROW_START+4;
		
		// Baris judul
		$worksheetReport->mergeCellsByColumnAndRow(
				IDX_COL_HOME, $rowBaseTable-1,
				IDX_COL_HOME+TABLE_COLS-1, $rowBaseTable-1)
				->setCellValueByColumnAndRow(IDX_COL_HOME, $rowBaseTable-1,
						"Total: ".$jmlHasil);
		
		$worksheetReport->mergeCellsByColumnAndRow(
				IDX_COL_HOME, $rowBaseTable,
				IDX_COL_HOME+TABLE_COLS-1, $rowBaseTable)
				->setCellValueByColumnAndRow(IDX_COL_HOME, $rowBaseTable,
						date("d m Y, H:i"));
		
		// Baris header tabel
		$worksheetReport->mergeCellsByColumnAndRow(
				IDX_COL_HOME, $rowBaseTable+1,
				IDX_COL_HOME, $rowBaseTable+2)
				->setCellValueByColumnAndRow(IDX_COL_HOME,$rowBaseTable+1,'Nomor');
		$worksheetReport->mergeCellsByColumnAndRow(
				IDX_COL_HOME+1, $rowBaseTable+1,
				IDX_COL_HOME+1, $rowBaseTable+2)
				->setCellValueByColumnAndRow(IDX_COL_HOME+1,$rowBaseTable+1,'Umur');
		
		$worksheetReport->mergeCellsByColumnAndRow(
				IDX_COL_HOME+2, $rowBaseTable+1,
				IDX_COL_HOME+2, $rowBaseTable+2)
				->setCellValueByColumnAndRow(IDX_COL_HOME+2,$rowBaseTable+1,'Jenis Kelamin');
		
		$worksheetReport->mergeCellsByColumnAndRow(
				IDX_COL_HOME+3, $rowBaseTable+1,
				IDX_COL_HOME+3, $rowBaseTable+2)
				->setCellValueByColumnAndRow(IDX_COL_HOME+3,$rowBaseTable+1,'Pendidikan');
				
		$worksheetReport->mergeCellsByColumnAndRow(
				IDX_COL_HOME+4, $rowBaseTable+1,
				IDX_COL_HOME+4, $rowBaseTable+2)
				->setCellValueByColumnAndRow(IDX_COL_HOME+4,$rowBaseTable+1,'Pekerjaan');		
				
		$worksheetReport->mergeCellsByColumnAndRow(
				IDX_COL_HOME+5, $rowBaseTable+1,
				IDX_COL_HOME+5, $rowBaseTable+2)
				->setCellValueByColumnAndRow(IDX_COL_HOME+5,$rowBaseTable+1,'Kuisioner 1');		
				
		$worksheetReport->mergeCellsByColumnAndRow(
				IDX_COL_HOME+6, $rowBaseTable+1,
				IDX_COL_HOME+6, $rowBaseTable+2)
				->setCellValueByColumnAndRow(IDX_COL_HOME+6,$rowBaseTable+1,'Kuisioner 2');		
				
		$worksheetReport->mergeCellsByColumnAndRow(
				IDX_COL_HOME+7, $rowBaseTable+1,
				IDX_COL_HOME+7, $rowBaseTable+2)
				->setCellValueByColumnAndRow(IDX_COL_HOME+7,$rowBaseTable+1,'Kuisioner 3');		
				
		$worksheetReport->mergeCellsByColumnAndRow(
				IDX_COL_HOME+8, $rowBaseTable+1,
				IDX_COL_HOME+8, $rowBaseTable+2)
				->setCellValueByColumnAndRow(IDX_COL_HOME+8,$rowBaseTable+1,'Kuisioner 4');		
				
		$worksheetReport->mergeCellsByColumnAndRow(
				IDX_COL_HOME+9, $rowBaseTable+1,
				IDX_COL_HOME+9, $rowBaseTable+2)
				->setCellValueByColumnAndRow(IDX_COL_HOME+9,$rowBaseTable+1,'Kuisioner 5');		
				
		$worksheetReport->mergeCellsByColumnAndRow(
				IDX_COL_HOME+10, $rowBaseTable+1,
				IDX_COL_HOME+10, $rowBaseTable+2)
				->setCellValueByColumnAndRow(IDX_COL_HOME+10,$rowBaseTable+1,'Kuisioner 6');		
				
		$worksheetReport->mergeCellsByColumnAndRow(
				IDX_COL_HOME+11, $rowBaseTable+1,
				IDX_COL_HOME+11, $rowBaseTable+2)
				->setCellValueByColumnAndRow(IDX_COL_HOME+11,$rowBaseTable+1,'Kuisioner 7');		
				
		$worksheetReport->mergeCellsByColumnAndRow(
				IDX_COL_HOME+12, $rowBaseTable+1,
				IDX_COL_HOME+12, $rowBaseTable+2)
				->setCellValueByColumnAndRow(IDX_COL_HOME+12,$rowBaseTable+1,'Kuisioner 8');		
				
		$worksheetReport->mergeCellsByColumnAndRow(
				IDX_COL_HOME+13, $rowBaseTable+1,
				IDX_COL_HOME+13, $rowBaseTable+2)
				->setCellValueByColumnAndRow(IDX_COL_HOME+13,$rowBaseTable+1,'Kuisioner 9');		
				
		$worksheetReport->mergeCellsByColumnAndRow(
				IDX_COL_HOME+14, $rowBaseTable+1,
				IDX_COL_HOME+14, $rowBaseTable+2)
				->setCellValueByColumnAndRow(IDX_COL_HOME+14,$rowBaseTable+1,'Kuisioner 10');

		$worksheetReport->mergeCellsByColumnAndRow(
				IDX_COL_HOME+15, $rowBaseTable+1,
				IDX_COL_HOME+15, $rowBaseTable+2)
				->setCellValueByColumnAndRow(IDX_COL_HOME+15,$rowBaseTable+1,'Kuisioner 11');
				
		$worksheetReport->mergeCellsByColumnAndRow(
				IDX_COL_HOME+16, $rowBaseTable+1,
				IDX_COL_HOME+16, $rowBaseTable+2)
				->setCellValueByColumnAndRow(IDX_COL_HOME+16,$rowBaseTable+1,'Kuisioner 12');	

		$worksheetReport->mergeCellsByColumnAndRow(
				IDX_COL_HOME+17, $rowBaseTable+1,
				IDX_COL_HOME+17, $rowBaseTable+2)
				->setCellValueByColumnAndRow(IDX_COL_HOME+17,$rowBaseTable+1,'Kuisioner 13');
				
		$worksheetReport->mergeCellsByColumnAndRow(
				IDX_COL_HOME+18, $rowBaseTable+1,
				IDX_COL_HOME+18, $rowBaseTable+2)
				->setCellValueByColumnAndRow(IDX_COL_HOME+18,$rowBaseTable+1,'Kuisioner 14');		
				
		
		
		// Set border header
		$worksheetReport->getStyleByColumnAndRow(
				IDX_COL_HOME,$rowBaseTable+1,
				IDX_COL_HOME+TABLE_COLS-1,$rowBaseTable+2)
				->applyFromArray($styleHeader)
				->applyFromArray($styleBorderAll)
				->applyFromArray($styleGrayBg);
		
		// Isi body tabel
		$counterItem	= 0;
		$currentRow		= $rowBaseTable + 3;
		foreach ($listRespon as $itemResult) {
			$counterItem++;
			$worksheetReport->setCellValueByColumnAndRow(
					IDX_COL_HOME, $currentRow, $itemResult['nomer']);
			$worksheetReport->setCellValueByColumnAndRow(
					IDX_COL_HOME+1, $currentRow, $itemResult['umur']);
			$worksheetReport->setCellValueByColumnAndRow(
					IDX_COL_HOME+2, $currentRow, $itemResult['jenkel']);
			$worksheetReport->setCellValueByColumnAndRow(
					IDX_COL_HOME+3, $currentRow, $itemResult['pendidikan']);
			$worksheetReport->setCellValueByColumnAndRow(
					IDX_COL_HOME+4, $currentRow, $itemResult['pekerjaan']);
			$worksheetReport->setCellValueByColumnAndRow(
					IDX_COL_HOME+5, $currentRow, $itemResult['prosedur']);
			$worksheetReport->setCellValueByColumnAndRow(
					IDX_COL_HOME+6, $currentRow, $itemResult['persyaratan']);
			$worksheetReport->setCellValueByColumnAndRow(
					IDX_COL_HOME+7, $currentRow, $itemResult['kejelasan']);
			$worksheetReport->setCellValueByColumnAndRow(
					IDX_COL_HOME+8, $currentRow, $itemResult['kedisiplinan']);
			$worksheetReport->setCellValueByColumnAndRow(
					IDX_COL_HOME+9, $currentRow, $itemResult['tanggungjawab']);
			$worksheetReport->setCellValueByColumnAndRow(
					IDX_COL_HOME+10, $currentRow, $itemResult['kemampuan']);
			$worksheetReport->setCellValueByColumnAndRow(
					IDX_COL_HOME+11, $currentRow, $itemResult['kecepatan']);
			$worksheetReport->setCellValueByColumnAndRow(
					IDX_COL_HOME+12, $currentRow, $itemResult['keadilan']);
			$worksheetReport->setCellValueByColumnAndRow(
					IDX_COL_HOME+13, $currentRow, $itemResult['kesopanan']);
			$worksheetReport->setCellValueByColumnAndRow(
					IDX_COL_HOME+14, $currentRow, $itemResult['kewajaranBiaya']);
			$worksheetReport->setCellValueByColumnAndRow(
					IDX_COL_HOME+15, $currentRow, $itemResult['kepastianBiaya']);
			$worksheetReport->setCellValueByColumnAndRow(
					IDX_COL_HOME+16, $currentRow, $itemResult['kepastianJadwal']);
			$worksheetReport->setCellValueByColumnAndRow(
					IDX_COL_HOME+17, $currentRow, $itemResult['kenyamanan']);		
			$worksheetReport->setCellValueByColumnAndRow(
					IDX_COL_HOME+18, $currentRow, $itemResult['keamanan']);
			
			$currentRow++;
		}
		// Set border untuk seluruh cell
		$worksheetReport->getStyleByColumnAndRow(
				IDX_COL_HOME,$rowBaseTable+1,
				IDX_COL_HOME+TABLE_COLS-1,$currentRow-1)
				->applyFromArray($styleBorderAll);
		
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$exportFileName.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	} catch (Exception $e) {
		die('[PHPExcel error] '.$e->getMessage()."<br> Trace:<br>".$e->getTraceAsString());
	}
}