<div>
    <nav>
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link minus" href="" id="<?php echo $product->id ?>" style="height: 38px;"><b>-</b></a>
            </li>
            <li class="page-item">
                <input type="text" value="1" class="form-control text-center"
                       onkeydown="return false;" style="max-width: 55px"
                       id="<?php echo 'amount'.$product->id ?>"/>
            </li>
            <li class="page-item">
                <a class="page-link plus" href="" id="<?php echo $product->id ?>" style="height: 38px;"><b>+</b></a>
            </li>
        </ul>
    </nav>
</div>
