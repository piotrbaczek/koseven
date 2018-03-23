<?php

class Controller_Welcome extends Controller
{
    public function action_index()
    {
        Auth::instance()->logout(true);
        $this->response->status(401)->headers('content-type', 'application/json')->body(json_encode(['status' => -99]));
    }

} // End Welcome
