<?php
// protected/views/report/index.php

$this->pageTitle = 'ТОП-10 авторов за год';
?>

<div class="section-header">
  <h2 class="section-title">ТОП-10 авторов за год</h2>
</div>

<div class="card mb-4">
  <div class="card-body">
    <?php echo CHtml::beginForm(array('report/index'), 'get', array('class' => 'row g-3 align-items-end')); ?>
    <div class="col-auto">
      <label for="year" class="col-form-label">Введите год:</label>
    </div>
    <div class="col-auto">
      <?php echo CHtml::numberField('year', $year, array(
        'id' => 'year',
        'min' => 1000,
        'max' => 2100,
        'class' => 'form-control',
        'placeholder' => 'Год'
      )); ?>
    </div>
    <div class="col-auto">
      <?php echo CHtml::submitButton('Показать', array('class' => 'btn btn-primary')); ?>
    </div>
    <?php echo CHtml::endForm(); ?>
  </div>
</div>

<?php if ($dataProvider !== null): ?>
  <?php if ($dataProvider->totalItemCount > 0): ?>
    <div class="card">
      <div class="card-body p-0">
        <table class="table table-striped table-hover mb-0">
          <thead class="table-dark">
            <tr>
              <th scope="col" class="ps-4">#</th>
              <th scope="col">Автор</th>
              <th scope="col" class="text-end pe-4">Книг</th>
            </tr>
          </thead>
          <tbody>
            <?php $index = 1; ?>
            <?php foreach ($dataProvider->getData() as $row): ?>
              <tr>
                <th scope="row" class="ps-4 text-primary fw-bold"><?php echo $index++; ?></th>
                <td><?php echo CHtml::encode($row['full_name']); ?></td>
                <td class="text-end pe-4"><?php echo CHtml::encode($row['books_count']); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  <?php else: ?>
    <div class="alert alert-info">Нет данных за указанный год.</div>
  <?php endif; ?>
<?php endif; ?>