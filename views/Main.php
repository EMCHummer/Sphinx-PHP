<div clss="row">
  <div class="col-12">
    <form method="post">
      <div class="form-group">
        <h3>Введите поисковой запрос</h3>
        <br>
        <input type="text" class="form-control" placeholder="Поиск..." name="search" value="<?=$_POST['search']?>">
      </div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" name="AcceptHTML"<?=($_POST['AcceptHTML'])?' checked':''?>>
        <label class="form-check-label">Выводить HTML теги как текст</label>
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Отправить запрос</button>
    </form>
  </div>
<div>
<br>
<div clss="row">
  <div class="col-12">
    <h3>Результаты поиска:</h3>
    <br>
    <?php if ($this->checkContext()): ?>
      <div class="table-responsive">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <?php foreach ($this->getTableHead() as $headName): ?>
                <th><?=$headName?></th>
              <?php endforeach; ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($this->getTableBody() as $key => $row): ?>
              <tr>
                <th><?=($key+1)?></th>
              <?php foreach ($row as $element): ?>
                <td><?=($_POST['AcceptHTML'])?str_replace(['<','>'],['&lt;','&gt;'],$element):$element?></td>
              <?php endforeach; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php elseif (!empty($this->getSphynxErrors())): ?>
      <div class="alert alert-danger" role="alert">
        ERROR : <?=$this->getSphynxErrors();?>
      </div>
    <?php else: ?>
      <p>Ничего не найдено</p>
    <?php endif; ?>
  </div>
<div>
