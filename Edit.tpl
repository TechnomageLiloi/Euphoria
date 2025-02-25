<div id="edit" style="text-align: center;">
    <a href="javascript:void(0)" class="butn" onclick="Requests.save('<?php echo $entity->getKey(); ?>');">Save</a>
    <table>
        <tr>
            <td>Title</td>
            <td><input type="text" name="title" value="<?php echo $entity->getTitle(); ?>"></td>
        </tr>
        <tr>
            <td>Price</td>
            <td><input type="text" name="price" value="<?php echo $entity->getPrice(); ?>"></td>
        </tr>
        <tr>
            <td>Datetime</td>
            <td><input type="text" name="dt" value="<?php echo $entity->getDt(); ?>"></td>
        </tr>
        <tr>
            <td>Summary</td>
            <td><input type="text" name="summary" value="<?php echo $entity->getSummary(); ?>"></td>
        </tr>
        <tr>
            <td>Data</td>
            <td><input type="text" name="data" value="<?php echo $entity->getData(); ?>"></td>
        </tr>
    </table>
    <a href="javascript:void(0)" class="butn" onclick="Requests.save('<?php echo $entity->getKey(); ?>');">Save</a>
</div>