<?PHP

$servername = "localhost";
$username = "mysql";
$password = "mysql";
$dbname = "sku";


function parse_excel_file( $filename ){
	// подключаем библиотеку
	require_once dirname(__FILE__) . '/PHPExcel-1.8/Classes/PHPExcel.php';

	$result = array();

	// получаем тип файла (xls, xlsx), чтобы правильно его обработать
	$file_type = PHPExcel_IOFactory::identify( $filename );
	// создаем объект для чтения
	$objReader = PHPExcel_IOFactory::createReader( $file_type );
	$objPHPExcel = $objReader->load( $filename ); // загружаем данные файла в объект
	$result = $objPHPExcel->getActiveSheet()->toArray(); // выгружаем данные из объекта в массив

	return $result;
}




// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$ar= parse_excel_file( dirname(__FILE__) . '/list.xlsx' );
// print_r($ar);
$sql = "SELECT art,name,part,ostatok,price FROM sku WHERE";
for ($i=0; $i < count($ar); $i++) {
	if($i == 0){
		$sql .= " art='".$ar[$i][0]."'";
	} else{
		$sql .= " OR art='".$ar[$i][0]."'";	
	};
};
	$result = $conn->query($sql);
	$data = array();

	if ($result->num_rows > 0) {
	     // output data of each row
	     while($row = $result->fetch_assoc()) {
	         $data[] = $row;
	     };
	     echo json_encode($data);
	} else {
	     echo "0 results";
	}
$conn->close();
