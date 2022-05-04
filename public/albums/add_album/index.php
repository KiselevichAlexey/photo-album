<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
?>
<div class="container">
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h2>Создание нового альбома</h2>
        <p class="lead">Below is an example form built entirely with Bootstrap's form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
      </div>
      <div class="row">
        </div>
        <div class="col-md-12 order-md-1">
          <div class="mess"></div>
          <form class="add_album" novalidate="">
            <div class="mb-3">
              <label for="username">Название альбома</label>
              <div class="input-group">
                <input name="NAME" type="text" class="form-control"  id="username" placeholder="Название альбома" required="">
                <div class="invalid-feedback" style="width: 100%;">
                 
                </div>
              </div>
              <label for="username">Описание альбома</label>
              <div class="input-group">
                <textarea name="DESCRIPTION" type="text" rows="4" class="form-control" id="username" placeholder="Описание альбома" required=""></textarea>
                <div class="invalid-feedback" style="width: 100%;">

                </div>
              </div>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Создать альбом</button>
          </form>
        </div>
      </div>

      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">© 2017-2018 Company Name</p>
      </footer>
    </div>


    
<script type="text/javascript">
	$(document).ready(function(){

		$('.add_album').submit(function(e){
			e.preventDefault();
			let form = $(this);
			let mess = $('.mess');
			let btn = form.find('button[type="submit"]');
			mess.html('');
			$('div.invalid-feedback.d-block').remove();
			btn.addClass('progress-bar-striped progress-bar-animated')

			$.ajax({
				url: "/ajax/add_album.php",
				type: 'POST',
				data: form.serialize(),
				success: function (json) {
          btn.removeClass('progress-bar-striped progress-bar-animated')
					let data = JSON.parse(json);
          console.log(data);
          for (key in data) {
              if(key == 'SUCCES'){
                mess.html('<div class="alert alert-success">' + data[key] + '</div>');
              }else{
                $('[name="'+ key +'"]').after(()=> '<div class="invalid-feedback d-block" style="width: 100%;">' + data[key] + '</div>')
              }
						}
				},
				error: function () {
          btn.removeClass('progress-bar-striped progress-bar-animated')
				}
			})

		})

	});
</script>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>