<?php

$command = filter_input(INPUT_GET, 'cmd');
if (isset($command) && $command == 'del') {
    $aid = filter_input(INPUT_GET, 'aid');
    if (isset($aid)) {
        $objArtist = (object) [
            'idartists' => $aid
        ];
        //kirim data ke post api
        $url = "http://localhost/cobarestapi/artist/delete.php";
        $content = json_encode($objArtist);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array("Content-type: application/json")
        );
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

        $json_response = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($status = 200) {
            echo $json_response;
        }

        curl_close($curl);
        
    }
}

$submitPressed = filter_input(INPUT_POST, "btnSubmit");
if ($submitPressed) {
    //get Data dari form
    $artistsName = filter_input(INPUT_POST, "txtArtistsName");
    $date = filter_input(INPUT_POST, "txtArtistsDebut");
    $date1 = str_replace('/', '-', $date);
    $artistsDebut = date('Y-m-d', strtotime($date1));
    $artistsCompany = filter_input(INPUT_POST, "txtArtistsCompany");

    //buat object utk json nya
    $objArtist = (object) [
        'name' => $artistsName,
        'debut' => $artistsDebut,
        'company' => $artistsCompany
    ];

    //kirim data ke post api
    $url = "http://localhost/cobarestapi/artist/create.php";
    $content = json_encode($objArtist);

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
        $curl,
        CURLOPT_HTTPHEADER,
        array("Content-type: application/json")
    );
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

    $json_response = curl_exec($curl);

    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ($status = 200) {
        echo $json_response;
    }

    curl_close($curl);
}
?>

<form method="POST" action="">
    <h2>Artist Form</h2>
    <div class="row row-space">
        <div class="col-2">
            <div class="input-group">
                <label class="label">Artist Name</label>
                <input class="input--style-4" type="text" name="txtArtistsName" placeholder="New Artist Name" required="">
            </div>
        </div>
    </div>
    <div class="row row-space">
        <div class="col-2">
            <div class="input-group">
                <label class="label">Artist Debut Date</label>
                <div class="input-group-icon">
                    <input class="input--style-4 js-datepicker" type="text" name="txtArtistsDebut">
                    <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-space">
        <div class="col-2">
            <div class="input-group">
                <label class="label">Artist Company</label>
                <input class="input--style-4" type="text" name="txtArtistsCompany" placeholder="New Artist Company" required="">
            </div>
        </div>
    </div>
    <div class="p-t-15">
        <input class="btn btn--radius-2 btn--blue" type="submit" Value="Submit" name="btnSubmit" />
    </div>
</form>

<br />

<?php
$json = file_get_contents("http://localhost/cobarestapi/artist/read.php");
$result = json_decode($json, true);
?>

<table id="tableId" class="display">
    <thead>
        <tr>
            <th>Artists ID</th>
            <th>Name</th>
            <th>Debut</th>
            <th>Company</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($result['records'] as $row) {
        ?>
            <tr>
                <td><?php echo $row['idartists'] ?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['debut'] ?></td>
                <td><?php echo $row['company'] ?></td>
                <?php
                if ($_SESSION['my_session']) {
                ?>
                    <td>
                        <button class="btn btn--radius-2 btn--green" type="submit" onclick="updateArtists('<?php echo $row['idartists'] ?>')">Update</button>
                        <button class="btn btn--radius-2 btn--red" type="submit" onclick="deleteArtists('<?php echo $row['idartists'] ?>')">Delete</button>
                    </td>
                <?php
                } else {
                ?>
                    <td>
                        <button disabled class="btn btn--radius-2 btn--grey" type="submit" onclick="updateArtists('<?php echo $row['idartists'] ?>')">Update</button>
                        <button disabled class="btn btn--radius-2 btn--grey" type="submit" onclick="deleteArtists('<?php echo $row['idartists'] ?>')">Delete</button>
                    </td>
                <?php
                }
                ?>
            </tr>
        <?php
        }
        $link = null;
        ?>
    </tbody>
</table>