<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function siteConfig()
    {
        return view('Install/siteConfig');
    }

    public function welcomePage(){

        $siteName = getDirectValue('generalsettings','value','name','sitename');
        $data['welcomeMsg'] = 'Your setup is successfully completed, Welcome '.$siteName;
        return view('Install/welcomePage', $data);
    }

    public function addSiteConfigs(){

        $data['siteName']       =  $this->request->getPost('sitename');
        $data['footertext']     =  $this->request->getPost('footertext');
        $data['smtpEmail']      =  $this->request->getPost('smtpEmail');
        $data['smtpPassword']   =  $this->request->getPost('smtpPassword');
        $data['smtpHost']       =  $this->request->getPost('smtpHost');
        $error = [];
        $builder = $this->db->table('generalsettings');


        foreach($_POST as $key=>$insertData){
            $datas['name'] = $key;
            $datas['value'] = $insertData;            
            try{
                $builder->insert($datas);
            }catch(Exception $e){
                $error[] = $e;
            }
        }

        // $this->welcomePage($error);
        return redirect()->to(base_url('welcomePage'));
    }

    
}
