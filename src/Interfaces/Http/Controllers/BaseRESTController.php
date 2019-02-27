<?php 

namespace Interfaces\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

use Illuminate\Http\Request as Request;

class BaseRESTController extends BaseController
{
    protected $_service;

    function __construct()
    {
    }

    public function Get()
    {
        $page = $this->RetrieveGetParam("int", "page", 1);
        $itemsperpage = $this->RetrieveGetParam("int", "itemsperpage", 10);
        
        return $this->_service->Get($page, $itemsperpage);
    }

    public function GetWithRelationships()
    {
        $page = $this->RetrieveGetParam("int", "page", 1);
        $itemsperpage = $this->RetrieveGetParam("int", "itemsperpage", 10);
        
        return $this->_service->GetWithRelationships($page, $itemsperpage);
    }

    public function Find($id)
    {
        return $this->_service->Find($id);
    }

    public function FindWithRelationships($id)
    {
        return $this->_service->FindWithRelationships($id);
    }

    public function Insert(Request $request)
    {
        return $this->_service->Insert($request->all());
    }

    public function Update(Request $request, $id)
    {
        return $this->_service->Update($id, $request->all());
    }

    public function Delete($id)
    {
        return $this->_service->Delete($id);
    }

    protected function RetrieveGetParam($type, $name, $default)
    {
        switch($type)
        {
            case "int":
                return (isset($_GET[$name])) ? (int) str_replace(' ', '', $_GET[$name]) : $default;
            case "string":
                return (isset($_GET[$name])) ? str_replace(' ', '', $_GET[$name]) : $default;
            default:
                return (isset($_GET[$name])) ? $_GET[$name] : $default;
        }
    }
}
