<div class="right__title" >Danh sách Challenge</div>
<?php if ($_SESSION['user']['roleId']==1): ?>
    <a href="index.php?controller=challenge&action=create" >
        <button style="width: 100px; margin-bottom: 20px" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</button>
    </a>
<?php endif; ?>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Tên Challenge</th>
        <th>Gợi ý</th>
        <th>Ngày tạo</th>
        <th>Trả lời</th>
    </tr>
    <?php if (!empty($challenges)): ?>
        <?php foreach ($challenges as $challenge): ?>
            <tr>
                <td><?php echo $challenge['id'] ?></td>
                <td><?php echo $challenge['title'] ?></td>
                <td><?php echo $challenge['suggest'] ?></td>
                <td><?php echo date('d-m-Y H:i:s', strtotime($challenge['createdAt'])) ?></td>
                <td><a href="<?php echo "index.php?controller=challenge&action=answer&id=".$challenge['id']; ?>">Trả lời</a></td>
                <?php if ($_SESSION['user']['id']==$challenge['userId']): ?>
                <td><a href="<?php echo "index.php?controller=challenge&action=delete&id=".$challenge['id']; ?>">Xóa</a></td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="9">Không Có Dữ Liệu</td>
        </tr>
    <?php endif; ?>
</table>