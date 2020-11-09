<div class="container">
    <h2>Приветсвую вас, мистер <?php echo $_SESSION['login']; ?> в личном кабинете!</h2>
    <?php if(isset($_SESSION['success'])): ?>
    <p><?php echo $_SESSION['success'] ?></p>
<?php endif; ?>

    <p>Это личный кабинет. Вы можете внести все данные о Вас или изменить в редакторе профиля</p>

    <div class="form-wrapp">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <h3>Данные моего профиля</h3>
                <div class="form-group">
                    <label for="login" class="">Логин:</label>
                    <input type="text" class="form-control" name="login" id="login" value="<?php echo (isset($login)) ? $login : "Че то не вышло"; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="full_name" class="">ФИО:</label>
                    <input type="text" class="form-control" id="full_name" placeholder="Здесь может быть ваше ФИО" value="<?php echo (isset($full_name)) ? $full_name : "Че то не вышло"; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="birth_date" class="">Дата рождения:</label>
                    <input type="date" class="form-control" id="birth_date" value="<?php echo (isset($birth_date)) ? $birth_date : "Че то не вышло"; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="position" class="">Должность</label>
                    <input type="text" class="form-control" id="position" placeholder="Здесь может быть ваша должность" value="<?php echo (isset($position)) ? $position : "Че то не вышло"; ?>" readonly>
                </div>
                <div id="add_field_area">
                <?  
                
                $n = 0;
                if (empty($arrPhone)) { ?>
                    <div id="add1" class="add form-group">
                        <label for="phone1" class="">Телефон:</label>
                        <input type="text" width="120" class="form-control phone" name="phone[]" id="phone1" onblur="writeFieldsVlues();" placeholder="Здесь может быть номер телефона"/>
                    </div>
                <?
                } else { 
                    foreach ($arrPhone as $value) {
                $n++;
                    if ($n == 1) { 
                ?><div id="add1" class="add form-group">
                        <label for="phone1" class="">Телефон:</label>
                        <input type="text" width="120" class="form-control phone" name="phone[]" id="phone1" onblur="writeFieldsVlues();" placeholder="+7 (999) 999-99-99" value="<?=$value?>"/>
                  </div>
                     <?
                    } else {			
                    ?>
                    <div id="add<?=$n?>" class="add">
                        <input type="text" width="120" class="form-control phone" name="phone[]" id="phone<?=$n?>" onblur="writeFieldsVlues();" placeholder="+7 (999) 999-99-99" value="<?=$value?>"/>
                    </div>
                    <?	
                    }
                }
                }
                    ?>
        </div>
            </div>
        </div>
    </div>
        



</div>
