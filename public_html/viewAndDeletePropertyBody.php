<br>
<div class="detailsContainer" itemscope itemtype="http://schema.org/Product">
    <div class="imageView">                        
        <article id=slider>
            <!-- Slider Setup -->
            <input class="rw" checked type=radio name=slider id=slide1 />
            <input class="rw" type=radio name=slider id=slide2 />
            <input class="rw" type=radio name=slider id=slide3 />
            <input class="rw" type=radio name=slider id=slide4 />
            <input class="rw" type=radio name=slider id=slide5 />
            <!-- The Slider -->
            <div id=slides>
                <div id=overflow>
                    <div class=inner>
                        <?php
                        $imageStop = 5;
                        for ($i = 0; $i < 5; $i++) {
                            if (empty($image[$i])) {
                                $imageStop = $i;
                                break;
                            }
                            //$imageLocation = str_replace('\\', '/', substr($image[$i], 45));//33
                            echo "<article>						
                                                    <img src='" . subStr($image[$i], 1) . ".jpg' height='auto' alt='$description' itemprop='image'>
                                                 </article>";
                        }
                        if ($imageStop === 0) {
                            echo "<article>						
                                                    <img src='uploads/house123.jpg' height='auto' alt='no image uploaded' itemprop='image'>
                                                 </article>";
                        }
                        ?>
                    </div> <!-- .inner -->
                </div> <!-- #overflow -->
            </div> <!-- #slides -->
            <!-- Controls and Active Slide Display -->
            <div id=controls>
                <?php
                for ($i = 1; $i <= $imageStop; $i++) {
                    echo "<label for=slide$i></label>";
                }
                ?>
            </div> <!-- #controls -->
            <div id=active>
                <?php
                for ($i = 1; $i <= $imageStop; $i++) {
                    echo "<label for=slide$i></label>";
                }
                ?>
            </div> <!-- #active -->
        </article>


    </div>                    
    <div class="detailsView">
        <table width='100%' border='1' style='background-color: #F2F2F2'>
            <tr>
                <td align='center'>
                    <?php
                    if ($premier == true) {
                        echo "<span class='premier'>Premier Agent<br></span>";
                    }
                    ?>
                </td>
                <td align='center'>
                    ID: <?php echo $contentID; ?>
                </td>
                <td align='center'>
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td align='center' width='33%'>
                    Price: <span id="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer"><span itemprop="priceCurrency" content="NGN"></span><span itemprop="price"><?php echo $price; ?></span></span>
                </td>
            <script>
                document.getElementById('price').innerHTML = price;
            </script>
            <td align='center' width='33%'>
                <span style='color: green'><?php echo $buy; ?></span>
            </td>
            <td align='center' width='33%'>
                State: <?php echo $state; ?>
            </td>
            </tr>
            <tr>
                <td align='center' width='33%'>
                    <span style='color: green'>LGA: <?php echo $LGA; ?></span>
                </td>
                <td align='center' width='33%'>
                    Asset: <span itemprop="name"><?php echo $asset; ?></span>
                </td>
                <td align='center' width='33%'>
                    <span <?php if ($asset = 'Car') { ?>itemprop="brand" itemscope itemtype="http://schema.org/Brand"<?php } ?> style='color: green'><?php
                        if ($asset == 'Car') {
                            echo "<span itemprop='name'>";
                        } echo $typeString
                        ?> <?php
                        if ($asset == 'Car') {
                            echo "</span>";
                        } echo $type . $sizeString;
                        ?></span>
                </td>
            </tr>
        </table>
        <span itemprop="description"><?php echo $description; ?></span>
    </div>
    <div class="mobileDetailsView">
        <br>
        <?php
        if ($premier == true) {
            echo "<span class='premier'>Premier Agent<br></span>";
        }
        ?>
        ID: <?php echo $contentID; ?><br>
        Price: <span id="price1">₦<?php echo $price; ?></span><br>                        
        <?php echo $buy; ?><br>
        State: <?php echo $state; ?><br>
        LGA: <?php echo $LGA; ?><br>
        Asset: <?php echo $asset; ?><br>
        <?php echo $typeString ?> <?php echo $type . $sizeString; ?><br>
        <?php echo $description; ?>
    </div>
    <script>
        document.getElementById('price1').innerHTML = price;
    </script>
</div>
<br>