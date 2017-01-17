<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 12.01.17
 * Time: 14:57
 */

require_once('db1/config.inc.php');
require_once('db1/functions.inc.php');

$tt = new test();

?>

<html>
  <head>
    <script src="js/api.js"></script>
    <script>
      function initialize() {
        var earth = new WE.map('earth_div');
        WE.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(earth);
       
	    <?php foreach($tt -> getRoutes() as $r){
		  $src_x = $r['src_x'];
          $src_x2 = $src_x + 0.000001;

          $src_y = $r['src_y'];
          $src_y2 = $src_y + 0.000001;

          $dst_x = $r['dst_x'];
          $dst_x2 = $dst_x + 0.000001;

          $dst_y = $r['dst_y'];
          $dst_y2 = $dst_y + 0.000001;
			?>

	   	 var polygonA = WE.polygon([[<?php echo $src_x?>,<?php echo $src_y?>],[<?php echo $src_x2?>,<?php echo $src_y2?>],[<?php echo $dst_x?>,<?php echo $dst_y?>],[<?php echo $dst_x2?>,<?php echo $dst_y2?>]],
            {
          color: '#ff0',
          opacity: 1,
          fillColor: '#f00',
          fillOpacity: 0.1,
          editable: false,
        weight: 2});
        polygonA.addTo(earth);
		<?php }?>
		
        /*var polygonA = WE.polygon([[49.5608, 5.811], [49.986, 5.723],
          [50.190, 6.086], [49.781, 6.536], [49.468, 6.372], [49.560, 5.811]]
                );
        polygonA.addTo(earth);

        var polygonB = WE.polygon([[46.15700, 5.9765625], [47.010, 6.525],
          [47.480, 6.965], [47.805, 8.613], [47.442, 9.645], [47.085, 9.459],
          [46.957, 10.447], [46.225, 10.140], [46.422, 9.272], [45.844, 9.030],
          [46.445, 8.360], [45.935, 7.811], [45.851, 7.141], [46.430, 6.734],
          [46.157, 5.976]], {
          color: '#ff0',
          opacity: 1,
          fillColor: '#f00',
          fillOpacity: 0.1,
          editable: false,
          weight: 2
        }).addTo(earth);*/

        earth.setView([48, 6], 5);
      }
    </script>
    <style>
      html, body{padding: 0; margin: 0;}
      #earth_div{top: 0; right: 0; bottom: 0; left: 0; 
                 background-color: #000; position: absolute !important;}
      </style>
      <title>WebGL Earth API: Polygon</title>
    </head>
    <body onLoad="initialize()">
      <div id="earth_div">
        <select id="airlines_namen">

          <?php foreach($tt -> getAirlines() as $r):?>

              <option><?=$r['name']?></option>

          <?php endforeach;?>

        </select>
      </div>
  </body>
</html>