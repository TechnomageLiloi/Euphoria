<div id="show" style="text-align: center;">

    <h3>Period: <?php echo $collection->getPeriod(); ?></h3>
    <h3>Price: <?php echo $collection->getPrice(); ?></h3>

    <table>
        <tr>
            <th>Timestamp</th>
            <th>Title</th>
            <th>Price</th>
            <th style="text-align: right;">Actions</th>
        </tr>
    <?php foreach($collection as $entity): ?>
        <tr>
            <td><?php echo $entity->getTimestamp("Y F d, g:i A"); ?></td>
            <td>
                <?php echo $entity->getTitle(); ?>
                <div style="color: gray;font-size: x-small;"><?php echo $entity->getSummary(); ?></div>
                <div style="color: silver;font-size: x-small;"><?php echo $entity->getData(); ?></div>
            </td>
            <td><?php echo $entity->getPrice(); ?></td>
            <td style="text-align: right;">
                <a href="javascript:void(0)" class="butn" onclick="Requests.edit('<?php echo $entity->getKey(); ?>');">Edit</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
</div>