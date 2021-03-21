<?php
$command = filter_input(INPUT_GET, 'cmd');
if (isset($command) && $command == 'del') {
    $aid = filter_input(INPUT_GET, 'aid');
    if (isset($aid)) {
        $result = deleteAlbums($aid);
        if ($result) {
            echo '<div class="bg-success">Data Successfully deleted</div>';
        } else {
            echo '<div class="bg-error">Delete failed</div>';
        }
    }
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
    $result = insertAlbums($title, $releaseDate, $producers, $artists);
    if ($result) {
        echo '<div class="bg-success">Data Successfully added (Albums: ' . $title . ')</div>';
    } else {
        echo '<div class="bg-error">Error add data</div>';
    }
}
?>

<form method="POST" action="">
    <h2>Album Form</h2>
    <div class="row row-space">
        <div class="col-2">
            <div class="input-group">
                <label class="label">Albums Title</label>
                <input class="input--style-4" type="text" name="txtAlbumsTitle" placeholder="New Albums Title" required="">
            </div>
        </div>
        <div class="col-2">
            <div class="input-group">
                <label class="label">Albums Release Date</label>
                <div class="input-group-icon">
                    <input class="input--style-4 js-datepicker" type="text" name="txtAlbumsReleaseDate">
                    <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-space">
        <div class="col-2">
            <div class="input-group">
                <label class="label">Albums Producers</label>
                <input class="input--style-4" type="text" name="txtAlbumsProducers" placeholder="New Albums Release Date" required="">
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
                <option disabled="disabled" selected="selected">Choose option</option>
                <?php foreach ($result2 as $row2) {
                    echo "<option value='" . $row2['idartists'] . "'>" . $row2['name'] . "</option>";
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

<br />

<?php
$result = getAlbumsData();
?>

<table id="tableId" class="display">
    <thead>
        <tr>
            <th>Album ID</th>
            <th>Title</th>
            <th>Release Date</th>
            <th>Producers</th>
            <th>Artist</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($result as $row) {
        ?>
            <tr>
                <td><?php echo $row['idalbums'] ?></td>
                <td><?php echo $row['title'] ?></td>
                <td><?php echo $row['releasedate'] ?></td>
                <td><?php echo $row['producers'] ?></td>
                <td><?php echo $row['name'] ?></td>
                <?php
                if ($_SESSION['my_session']) {
                ?>
                    <td>
                        <button class="btn btn--radius-2 btn--green" type="submit" onclick="updateAlbums('<?php echo $row['idalbums'] ?>')">Update</button>
                        <button class="btn btn--radius-2 btn--red" type="submit" onclick="deleteAlbums('<?php echo $row['idalbums'] ?>')">Delete</button>
                    </td>
                <?php
                } else {
                ?>
                    <td>
                        <button disabled class="btn btn--radius-2 btn--grey" type="submit" onclick="updateAlbums('<?php echo $row['idalbums'] ?>')">Update</button>
                        <button disabled class="btn btn--radius-2 btn--grey" type="submit" onclick="deleteAlbums('<?php echo $row['idalbums'] ?>')">Delete</button>
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