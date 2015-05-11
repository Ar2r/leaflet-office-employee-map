<?
error_reporting(E_ALL);
ini_set('display_errors','On');
ini_set('display_startup_errors','On');
//print_r($_POST);
$file_path = "json/db.json";
$data = json_decode( file_get_contents($file_path), true );


if(isset($_GET['user_id'])){
	// Добавляем или изменяем массив

	$data['points'][$_GET['user_id']] = array(
		'name' => $_GET['name'],
		'lat' => $_GET['lat'],
		'lng' => $_GET['lng']
	);

	$data['dt']=date("c");
	file_put_contents($file_path, json_encode($data));
}
readfile($file_path);
