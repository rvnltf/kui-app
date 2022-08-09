<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $exchange = new \App\Models\StudentAppliedModel();
        if (in_groups('admin')) {
            $user = new \Myth\Auth\Models\UserModel();

            $data = [
                'title' => "KUI - Administrator",
                'user' => $user->countAllResults(),
                'exchange' => $exchange->countAllResults(),
                'rejected' => $exchange->where('status', 2)->countAllResults(),
                'complete' => $exchange->where('status', 7)->countAllResults()
            ];
            return view('admin/index', $data);
        }
        $setting = new \App\Models\SettingsModel();
        $data = [
            'title' => "KUI - Mahasiswa",
            'exchange' => $exchange->getStudentAppliedById(user()->id),
            'no_wa' => $setting->getSetting('contact_us')
        ];
        return view('user/index', $data);
    }
}
