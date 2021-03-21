<?php
$aid = filter_input(INPUT_GET, "aid");
if (isset($aid)) {
    $result=getAlbumsDataWhereIdIs($aid);
}
$submitPressed = filter_input(INPUT_POST, "btnSubmit");
if ($submitPressed) {
    //get Data dari form
    $title = filter_input(INPUT_POST, "txtAlbumsTitle");
    $date = filter_input(INPUT_POST, "txtAlbumsReleaseDate");
    $date1 = str_replace('/', '-', $date);
    $releaseDate = date('Y-m-d', strtotime($date1));
    $producers = filter_input(INPUT_POST, "txtAlbumsProducers");
    $artists = filter_input(INPUT_POST, "txtArtists");
    //connect ke db
    updateAlbums($aid,$title,$releaseDate,$producers,$artists);
}
?>

<form method="POST" action="">
    <h2>Update Album</h2>
    <div class="row row-space">
        <div class="col-2">
            <div class="input-group">
                <label class="label">Albums Title</label>
                <input class="input--style-4" type="text" name="txtAlbumsTitle" placeholder="New Albums Title" required="" value="<?php echo $result['title'] ?>">
            </div>
        </div>
        <div class="col-2">
            <div class="input-group">
                <label class="label">Albums Release Date</label>
                <div class="input-group-icon">
                    <input class="input--style-4 js-datepicker" type="text" name="txtAlbumsReleaseDate" value="<?php echo date('d-m-Y', strtotime($result['releasedate'])) ?>">
                    <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-space">
        <div class="col-2">
            <div class="input-group">
                <label class="label">Albums Producers</label>
                <input class="input--style-4" type="text" name="txtAlbumsProducers" placeholder="New Albums Release Date" required="" value="<?php echo $result['producers'] ?>">
            </div>
        </div>
    </div>
    <div class="input-group">
        <label class="label">Artists</label>
        <?php
        $result2 = getArtistsData();
        ?>
        <div class="rs-select2 js-select-simple select--no-search">
            <select name="txtArtists">
                <option disabled="disabled" selected="selected" >Choose option</option>
                <?php foreach ($result2 as $row2) {
                    if($row2['idartists'] == $result['artists_idartists']){
                        echo "<option value='" . $row2['idartists'] . "' selected>" . $row2['name'] . "</option>";
                    }
                    else {
                        echo "<option value='" . $row2['idartists'] . "'>" . $row2['name'] . "</option>";
                    }
                    
                }
                $link2 = null;
                ?>
            </select>
            <div class="select-dropdown"></div>
        </div>
    </div>
    <div class="p-t-15">
        <input class="btn btn--radius-2 btn--blue" type="submit" Value="Submit" name="btnSubmit" />
    </div>
</form>