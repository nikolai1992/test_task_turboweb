<?php foreach($dogs as $dog):;?>
    <?php if ($dogs_action == "sound"):?>
        <?php if ($dog["sound"]):?>
            <p><?php echo date("Y.m.d H:i:s");?> - "<?php echo $dog["name"];?>": <?php echo $dog["sound"];?></p>
        <?php else:?>
            <p><?php echo date("Y.m.d H:i:s");?> - Cобака "<?php echo $dog["name"];?>" не може робити звуки.</p>
        <?php endif?>
    <?php else:?>
        <?php if ($dog["can_hunting"]):?>
            <?php if (!$dog["hunting_laziness_level"]):?>
                <p><?php echo date("Y.m.d H:i:s");?> - Cобака "<?php echo $dog["name"]?>" пішла на полювання.</p>
            <?php elseif(rand(0, 100) > $dog["hunting_laziness_level"]):?>
                <p><?php echo date("Y.m.d H:i:s");?> - Cобака "<?php echo $dog["name"]?>" пішла на полювання.</p>
            <?php else:?>
                <p><?php echo date("Y.m.d H:i:s");?> - Cобака "<?php echo $dog["name"]?>" полює лінь.</p>
            <?php endif?>
        <?php else:?>
            <p><?php echo date("Y.m.d H:i:s");?> - Cобака "<?php echo $dog["name"]?>" не може полювати.</p>
        <?php endif?>
    <?php endif?>

<?php endforeach;?>