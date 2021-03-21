<?php
$aid = filter_input(INPUT_GET, "aid");
if (isset($aid)) {
    $json = file_get_contents("http://localhost/cobarestapi/artist/read_one.php?id=".$aid);
    $result = json_decode($json, true);
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
        'idartists' => $aid,
        'name' => $artistsName,
        'debut' => $artistsDebut,
        'company' => $artistsCompany
    ];

    //kirim data ke post api
    $url = "http://localhost/cobarestapi/artist/update.php";
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
    header("location:index.php?navito=artists");
}
?>

<form method="POST" action="">
    <h2>Artist Form</h2>
    <div class="row row-space">
        <div class="col-2">
            <div class="input-group">
                <label class="label">Artist Name</label>
                <input class="input--style-4" type="text" name="txtArtistsName" placeholder="New Artist Name" required="" value="<?php echo $result['name'] ?>">
            </div>
        </div>
    </div>
    <div class="row row-space">
        <div class="col-2">
            <div class="input-group">
                <label class="label">Artist Debut Date</label>
                <div class="input-group-icon">
                    <input class="input--style-4 js-datepicker" type="text" name="txtArtistsDebut" value="<?php echo date('d-m-Y', strtotime($result['debut'])) ?>">
                    <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-space">
        <div class="col-2">
            <div class="input-group">
                <label class="label">Artist Company</label>
                <input class="input--style-4" type="text" name="txtArtistsCompany" placeholder="New Artist Company" required="" value="<?php echo $result['company'] ?>">
            </div>
        </div>
    </div>
    <div class="p-t-15">
        <input class="btn btn--radius-2 btn--blue" type="submit" Value="Submit" name="btnSubmit" />
    </div>
</form>

<br />

