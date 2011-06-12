<?php

class LoginController extends Controller {

    public $defaultAction = 'login';

    public function actionIndex() {
        $this->render('index');
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                $this->lastLogin();
                $this->redirect(app()->user->returnUrl);
            }
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    private function lastLogin() {
        $lastlogin = User::model()->notsafe()->findByPk(app()->user->id);
        $lastlogin->lastlogin = date("Y-m-d H:i:s");
        $lastlogin->save();
    }

}