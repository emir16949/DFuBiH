<?php
    function zag() {
        header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
        header('Content-Type: text/html');
        header('Access-Control-Allow-Origin: *');
    }
	
	function rest_get($request, $data) { }
    function rest_post($request, $data) { }
    function rest_delete($request) { }
    function rest_put($request, $data) { }
    function rest_error($request) { }

    $method  = $_SERVER['REQUEST_METHOD'];
    $request = $_SERVER['REQUEST_URI'];
	
    switch($method) {
        case 'PUT':
            parse_str(file_get_contents('php://input'), $put_vars);
            zag(); $data = $put_vars; rest_put($request, $data); break;
        case 'POST':
            zag(); $data = $_POST; rest_post($request, $data); break;
        case 'GET':

	//	$veza = new PDO('mysql:host=' . getenv('MYSQL_SERVICE_HOST') . ';port=3306;dbname=baza', 'admin', 'adminpass');
		$veza = new PDO("mysql:dbname=baza;host=localhost;charset=utf8", "root", "");
        $veza->exec("set names utf8");
             
        zag();
		$data = $_GET;
		rest_get($request, $data);

		if(isset ($_GET['korisnik_id']))
		{
			$id_korisnik = $_GET['korisnik_id'];
            $upit = $veza->prepare("SELECT * FROM korisnik WHERE id=?");
			$upit->bindValue(1, $id_korisnik, PDO::PARAM_INT);
            $upit->execute();
		}
        elseif (isset ($_GET['novost_id']))
        {
			$novost_id = $_GET['novost_id'];
            $upit = $veza->prepare("SELECT * FROM novost WHERE id=?");
			$upit->bindValue(1, $novost_id, PDO::PARAM_INT);
            $upit->execute();
        }
		elseif (isset ($_GET['takmicar_id']))
        {
			$takmicar_id = $_GET['takmicar_id'];
            $upit = $veza->prepare("SELECT * FROM takmicar WHERE id=?");
			$upit->bindValue(1, $takmicar_id, PDO::PARAM_INT);
            $upit->execute();
        }
            
        $rezultat = array();
        while($row = $upit->fetch(PDO::FETCH_ASSOC))
		{
			$rezultat[] = $row;
        }

        print json_encode($rezultat);
        break;
			
        case 'DELETE':
            zag(); rest_delete($request); break;
        default:
            header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
            est_error($request); break;
        }
?>