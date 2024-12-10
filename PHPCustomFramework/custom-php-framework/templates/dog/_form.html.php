<?php
    /** @var $dog ?\App\Model\Dog */
?>

<div class="form-group">
    <label for="name">Name</label>
    <input type="text" id="name" name="dog[name]" value="<?= $dog ? $dog->getName() : '' ?>">
</div>

<div class="form-group">
    <label for="breed">Breed</label>
    <input type="text" id="breed" name="dog[breed]" value="<?= $dog? $dog->getBreed() : '' ?>">
</div>

<div class="form-group">
    <label for="gender">Gender</label>
    <input type="text" id="gender" name="dog[gender]" value="<?= $dog? $dog->getGender() : '' ?>">
</div>

<div class="form-group">
    <label></label>
    <input type="submit" value="Submit">
</div>
