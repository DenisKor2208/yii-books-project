<h1>ТОП-10 авторов по количеству книг за год</h1>

<?php echo CHtml::beginForm(array('report/index'), 'get'); ?>
<label for="year">Введите год:</label>
<?php echo CHtml::numberField('year', $year, array('id' => 'year', 'min' => 1000, 'max' => 2100)); ?>
<?php echo CHtml::submitButton('Показать'); ?>
<?php echo CHtml::endForm(); ?>

<?php if ($dataProvider !== null): ?>
  <?php if ($dataProvider->totalItemCount > 0): ?>
    <h2>Результаты за <?php echo CHtml::encode($year); ?> год</h2>
    <table border="1" cellpadding="5">
      <tr>
        <th>Автор</th>
        <th>Количество книг</th>
      </tr>
      <?php foreach ($dataProvider->getData() as $row): ?>
        <tr>
          <td><?php echo CHtml::encode($row['full_name']); ?></td>
          <td><?php echo CHtml::encode($row['books_count']); ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php else: ?>
    <p>Нет данных за указанный год.</p>
  <?php endif; ?>
<?php endif; ?>