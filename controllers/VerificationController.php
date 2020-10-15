<?php


namespace app\controllers;


class VerificationController extends MainController
{


    public function allAction()
    {
        return $this->renderer->render('verificationIndex');
    }
}