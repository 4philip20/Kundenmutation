<meta charset="utf-8"/>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="include/main.css" rel="stylesheet">
<script src="include/java.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <h3>Kudemutierung Überischt</h3>
    <hr>
    <div class="row">
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Mutierungen</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span>
                        Filter
                    </button>
                </div>
            </div>
            <table class="table">
                <thead>
                <tr class="filters">
                    <th><input type="text" class="form-control" placeholder="#ID" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Debitor Nr" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Formular Art" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Mutation Art" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Auftraggeber" disabled></th>
					<th><input type="text" class="form-control" placeholder="Datum" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Filename" disabled></th>
                </tr>
                </thead>
                <tbody>


                <?php
                $servername = "localhost";
                $username = "ESAKdMut";
                $password = "ESAKdMut19";
                $dbname = "esa_kundenmutation_2";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM formular";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
						$ID = $row["ID"];
                        $FILE = $row["FILE"];
						if($row["formularart"] == "esa"){
                            //Esa Formular
                            $location = "http://intranet.esa.ch/netprog/kdmut/index.php?action=d&art=esa&kdmut=$ID";
                        }else{
                            //retail Formular
                            $location = "http://intranet.esa.ch/netprog/kdmut/index.php?action=d&art=retail&kdmut=$ID";
                        }
						
                        
                        //$location = "http://intranet.esa.ch/netprog/kdmut/index.php?action=d&kdmut=$ID";
                        $location2 = "http://intranet.esa.ch/netprog/kdmut/$FILE";

                        echo "
		    <tr >
				<td onclick=\"document . location = '$location';\">" . $row["ID"] . "</td>
				<td onclick=\"document . location = '$location';\">" . $row["PVDN"] . "</td>
				<td onclick=\"document . location = '$location';\">" . $row["formularart"] . "</td>
				<td onclick=\"document . location = '$location';\">" . $row["ART"] . "</td>
				<td onclick=\"document . location = '$location';\">" . $row["auftraggeber"] . "</td>
				<td onclick=\"document . location = '$location';\">" . $row["timestamp"] . "</td>
				<td onclick=\"document . location = '$location2';\" class='fileHover'>" . $row["FILE"] . "</td>
			</tr>
		";
                    }
                } else {
                    echo "Keine Mutierungen auf der Datenbank gefunden";
                }
                $conn->close();
                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>