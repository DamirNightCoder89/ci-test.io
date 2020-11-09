<div class="container">
<div class="form-wrapp">
 <div class="row">
 <div class="col-md-offset-3 col-md-6">
 <?php if(isset($_SESSION['success'])): ?>
    <p><?php echo $_SESSION['success'] ?></p>
<?php endif; ?>
<?php echo form_open('user/update_set', array('class' => 'form-horizontal')); ?>
        <div class="form-group">
            <label for="login" class="">Логин:</label>
            <input type="text" class="form-control" name="login" id="login" value="<?php echo (isset($login)) ? $login : set_value('login'); ?>">
            <?php echo form_error('login', '<p class="text-danger">', '</p>'); ?>
        </div>
        <div class="form-group">
            <label for="password" class="">Пароль:</label>
            <input type="password" class="form-control" name="password" id="password">
            <?php echo form_error('password', '<p class="text-danger">', '</p>'); ?>
        </div>
        <div class="form-group">
            <label for="password2" class="">Повторите пароль:</label>
            <input type="password" class="form-control" name="password2" id="password2">
            <?php echo form_error('password2', '<p class="text-danger">', '</p>'); ?>
        </div>
        <div class="form-group">
            <label for="full_name" class="">ФИО:</label>
            <input type="text" class="form-control" name="full_name" id="full_name" value="<?php echo (isset($full_name)) ? $full_name : set_value('full_name'); ?>">
        </div>
        <div class="form-group">
            <label for="birth_date" class="">Дата рождения:</label>
            <input type="date" class="form-control" name="birth_date" id="birth_date" value="<?php echo (isset($birth_date)) ? $birth_date : set_value('birth_date'); ?>">
        </div>
        <div class="form-group">
            <label for="position" class="">Должность</label>
            <input type="text" class="form-control" name="position" id="position" value="<?php echo (isset($position)) ? $position : set_value('position'); ?>">
        </div>
        <div id="add_field_area">
			<?  
            $n = 0;
            if (empty($arrPhone)) { ?>
                <div id="add1" class="add form-group">
                    <label for="phone1" class="">Телефон:</label>
                    <input type="text" width="120" class="form-control phone" name="phone[]" id="phone1" onblur="writeFieldsVlues();" placeholder="+7 (999) 999-99-99"/>
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
                    <div class="deletebutton" onclick="deleteField(<?=$n?>);">X</div>
                </div>
                <?	
                }
            }
            }
                ?>
        </div>
        <div onclick="addField();" class="addbutton">Добавить поле</div>

        <div class="text-center">
        <p ><input type="submit" class="btn_update" value="Сохранить"></p>
        </div>
    </form>
    </div>
    </div>
    </div>
    </div>
