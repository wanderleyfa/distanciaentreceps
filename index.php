<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Distancia entre ceps - Wanderley Albuquerque</title>

<!-- Bootstrap core CSS -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
<link href="bootstrap/css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="bootstrap/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="bootstrap/assets/js/ie-emulation-modes-warning.js"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->



</head>

<body>

    <div class="container">

        <form class="form-signin" role="form" method="post">
            <h2 class="form-signin-heading">Favor informar</h2>
            <label> CEP de Origem <input name="origem" id="origem"
                class="form-control" placeholder="00000-000" required autofocus></label>
            <label> CEP de Destino <input name="destino" id="destino"
                class="form-control" placeholder="00000-000" required></label>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Pesquisar</button>
        </form>

    </div>
    <!-- /container -->


    <div class="container">
        <div>
<?php
if ($_SERVER ['REQUEST_METHOD'] == "POST") {
    ?>

<h2 class="form-signin-heading">Resultados</h2>

    
<?php
    
    $origins = $_POST ["origem"];
    $destinations = $_POST ["destino"];
    $mode = 'CAR';
    $language = 'pt-br';
    $sensor = 'false';
    
    if ($origins != '' && $destinations != '') {
        
        $link = ('http://maps.googleapis.com/maps/api/distancematrix/xml?origins=' . $origins . '|&destinations=' . $destinations . '|&mode=' . $mode . '|&language=' . $language . '|&sensor=false');
        
        $xml = simplexml_load_file ( $link );
        
        echo "<strong>Origem:</strong> cep " . $origins . ' - ' . ($xml->{'origin_address'}) . "<br />";
        echo "<strong>Destino:</strong> cep " . $destinations . ' - ' . ($xml->{'destination_address'}) . "<br />";
        
        foreach ( $xml->row as $item ) { // faz o loop nas tag com o nome "item" //exibe o valor das tags que estão dentro da tag "item" //utilizamos a função "utf8_decode" para exibir os caracteres corretamente
            
            echo "<strong>Distancia:</strong> " . utf8_decode ( $item->element->distance->text ) . "<br />";
            
            echo "<strong>Tempo de viagem:</strong> " . utf8_decode ( $item->element->duration->text ) . "<br />";
            
            echo "<br />";
        }
    } else {
        print 'Favor informar os dois ceps.';
    }
}
?>    </div>
    </div>
</body>
</html>
