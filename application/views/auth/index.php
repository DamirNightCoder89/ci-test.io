<div class="container">
    <div class="form-wrapp">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <?php if (isset($_SESSION['error_log'])) : ?>
                    <p class="text-danger"><?php echo $_SESSION['error_log'] ?></p>
                <?php endif; ?>
                <div class="tab" role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="<?php echo (isset($active_in)) ? "active" : ((isset($active_reg)) ? "not" : "active"); ?>"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">Вход</a></li>
                        <li role="presentation" class="<?php echo (isset($active_reg)) ? $active_reg : ""; ?>"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab">Регистрация</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content tabs">
                        <div role="tabpanel" class="<?php echo (isset($active_in)) ? "tab-pane fade in active" : ((isset($active_reg)) ? "tab-pane fade" : "tab-pane fade in active"); ?>" id="Section1">
                            <?php echo form_open('auth/login', array('class' => 'form-horizontal')); ?>
                            <div class="form-group">
                                <?php echo form_error('login_in', '<div class="alert alert-danger">', '</div>'); ?>
                                <label for="login_in" class="">Логин:</label>
                                <input type="text" class="form-control" name="login_in" id="login_in" placeholder="Введите логин" value="<?php echo set_value('login_in'); ?>">
                            </div>
                            <div class="form-group">
                                <label for="password_in" class="">Пароль:</label>
                                <input type="password" class="form-control" placeholder="Введите пороль" name="password_in" id="password_in">
                                <?php if (isset($_SESSION['error'])) : ?>
                                    <p class="text-danger"><?php echo $_SESSION['error'] ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="text-center">
                                <button name="register" class="btn btn-primary">Войти</button>
                            </div>
                            </form>
                        </div>
                        <div role="tabpanel" class="<?php echo (isset($active_reg)) ? "tab-pane fade in active" : "tab-pane fade"; ?>" id="Section2">
                            <?php echo form_open('auth/register', array('class' => 'form-horizontal')); ?>
                            <div class="form-group">
                                <label for="login" class="">Логин:</label>
                                <input type="text" class="form-control" name="login" id="login" placeholder="Введите логин" value="<?php echo set_value('login'); ?>">
                                <?php echo form_error('login', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="password" class="">Пароль:</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль">
                                <?php echo form_error('password', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="password2" class="">Повторите пароль:</label>
                                <input type="password" class="form-control" name="password2" id="password2" placeholder="Введите пароль">
                                <?php echo form_error('password2', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="full_name" class="">ФИО:</label>
                                <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Введите ФИО" value="<?php echo set_value('full_name'); ?>">
                            </div>
                            <div class="form-group">
                                <label for="birth_date" class="">Дата рождения:</label>
                                <input type="date" class="form-control" name="birth_date" id="birth_date" placeholder="Введите дату рождения" value="<?php echo set_value('birth_date'); ?>">
                            </div>
                            <div class="form-group">
                                <label for="position" class="">Должность</label>
                                <input type="text" class="form-control" name="position" id="position" placeholder="Введите должность" value="<?php echo set_value('position'); ?>">
                            </div>
                            <div id="add_field_area">
                                <div id="add1" class="add form-group">
                                    <label for="phone1" class="">Телефон:</label>
                                    <input type="text" width="120" class="form-control phone" name="phone[]" id="phone1" onblur="writeFieldsVlues();" placeholder="+7 (999) 999-99-99" />
                                </div>
                            </div>
                            <div onclick="addField();" class="addbutton">Добавить поле</div>


                            <div class="text-center">
                                <button name="register" class="btn btn-primary">Регистрация</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div><!-- /.col-md-offset-3 col-md-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div>

<div style="clear: both"></div>